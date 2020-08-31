<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Solicitud;
use App\Evento;
use App\Archivos;
use App\Queue;
use App\QueueTecnico;
use App\Http\Requests\ProductCreateRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

use App\Http\Requests\SolicitudRequest;
use App\Http\Resources\SolicitudResource as SolicitudResources;
use App\Http\Resources\EventoResource;
use App\Mail\MessageRecevied;
use Exception;

class SolicitudController extends Controller
{
	public function list(){
		$list = DB::table('solicitudes')
                ->leftJoin('users', 'users.id', '=', 'solicitudes.id_tecnico')
                ->leftJoin('estados', 'estados.id', '=', 'solicitudes.estado')
                ->leftJoin('archivos', 'archivos.id_solicitud', '=', 'solicitudes.id')
                ->where('solicitudes.id_user', '2')
                ->select('solicitudes.*', 'users.name as tecnico_name', 'users.email', 'estados.codigo as ecodigo','estados.descripcion as estado', 'estados.color','archivos.nombre', 'archivos.path')
                ->get();
		return response()->json(['data'=> SolicitudResources::collection($list)],200);
	}
    public function eventos($id){
        $list = DB::table('eventos')
                ->leftJoin('users', 'users.id', '=', 'eventos.id_tecnico')
                ->leftJoin('categorias', 'categorias.id', '=', 'eventos.id_categoria')
                ->where('eventos.id_solicitud', $id)
                ->select('eventos.*', 'users.name as tecnico', 'categorias.nombre as categoria', 'eventos.detalle')
                ->get();
        return response()->json(['data'=> EventoResource::collection($list), 'total' => count($list)],200);
    }
	public function listBy(Request $req){
		$filter = $req->filter;
		$value = $req->value;
		$list = Solicitud::where($filter, $value)->get();
		return response()->json(['list'=> SolicitudResources::collection($list)],200);
	}
	public function listTecnico($id){
		$list = DB::table('solicitudes')
                ->leftJoin('users', 'users.id', '=', 'solicitudes.id_user')
                ->leftJoin('estados', 'estados.id', '=', 'solicitudes.estado')
                ->leftJoin('categorias', 'categorias.id', '=', 'solicitudes.id_categoria')
                ->where('solicitudes.id_tecnico', $id)
                ->select('solicitudes.*', 'users.name as usuario','categorias.nombre as categoria', 'categorias.prioridad as prioridad')
                ->get();
		return response()->json(['data'=>SolicitudResources::collection($list)],200);
	}
	public function listSolicitados($id){
		$list = Solicitud::where('id_user', $id)->where('estado', '1')->get();
		return response()->json(['list'=> $list],200);
	}
	public function show($id){
		$solicitud = DB::table('solicitudes')
                        ->leftJoin('users', 'users.id', '=', 'solicitudes.id_user')
                        ->leftJoin('archivos', 'archivos.id_solicitud', '=', 'solicitudes.id')
                        ->leftJoin('categoria', 'categoria.id', '=', 'solicitudes.id_categoria')
                        ->where('solicitudes.id', $id)
                        ->select('solicitudes.*', 'users.name as usuario', 'archivos.nombre', 'archivos.path','categoria.nombre as categoria', 'categoria.prioridad as prioridad')
                        ->get();

		$eventos = Evento::where('id_solicitud', $id)->get();
		return response()->json(['solicitud'=> SolicitudResources::collection($solicitud), 'eventos' => $eventos],200);
	}
    public function store(SolicitudRequest $req){   
        try {
            $file = $req->file;
            $colaCategoria = DB::table('queues')->where('id_categoria', $req->id_categoria)->first();    
            if($colaCategoria != null){
                $solicitud = Solicitud::create($req->validated());
                $evento = $this->asignar($solicitud->id, $colaCategoria);
                $solicitud = Solicitud::findOrFail($solicitud->id);
                if($req->hasFile('file')){
                    $uploadFile = $this->handleFile($file, $solicitud->id);
                }
                return response()->json(['solicitud'=> new SolicitudResources($solicitud)], 200);
            }else{
                throw new Exception("No existe una cola de atencion para esta categoria");
            }
        } catch (Exception $e) {
            return response()->json(['msg'=> $e->getMessage()], 500);
        }
    }
    public function setEstado(Request $req){
    	$id_solicitud = $req->id_solicitud;
    	$estado = $req->estado;
    	$tecnico = $req->tecnico;
    	$detalle = $req->detalle;

    	$this->setEstadoSolicitud($id_solicitud, $estado);
    	$solicitud = Solicitud::findOrFail($id_solicitud);

    	$this->registarEvento($id_solicitud, $solicitud->id_categoria, $tecnico, $detalle);

    	return response()->json('OK', 200);
    }
    public function setCategoria(Request $req){
		$id_solicitud = $req->id_solicitud;
    	$categoria = $req->categoria;
    	$tecnico = $req->tecnico;
    	$detalle = $req->detalle;

    	$this->registarEvento($id_solicitud, $categoria, $tecnico, $detalle);

    	$evento = $this->asignar($id_solicitud, $tecnico);

    	return response()->json('OK', 200);
    }
 	private function asignar($solicitud, $colaCategoria, $detalle = 'asignado por el sistema'){        
            $tecnico = DB::table('queue_tecnicos')->where('id_cola', $colaCategoria->id)->where('turno', $colaCategoria->turno)->first();
            Solicitud::where('id', $solicitud)->update(['id_tecnico' => $tecnico->id]);
            $this->registarEvento($solicitud, $colaCategoria->id, $tecnico->id, $detalle);
            $nuevaPosicion = $this->siguienteCola($colaCategoria->id, $colaCategoria->turno, $tecnico->id);
            DB::table('queues')->where('id', $colaCategoria->id)->update(['turno'=> $nuevaPosicion]);
            // SEND MAIL TO TECNICO
            $solicitudMail = new SolicitudResources(Solicitud::findOrFail($solicitud));
            Mail::to('email@email.com')->queue(new MessageRecevied($solicitudMail));
            
            $this->setEstadoSolicitud($solicitud, 2);
    }
    private function siguienteCola($colaActual, $turnoActual, $tecnicoActual){
        $tecnicos = DB::table('queue_tecnicos')->where('id_cola', $colaActual)->get();
        $turnoInicial = $turnoActual;
		$nuevaPosicion = $turnoActual;
		foreach ($tecnicos as $tecnico_fila)
		{
			if($turnoInicial < $tecnico_fila->turno && $tecnico_fila->estado_tecnico_cola == '1')
			{
				$nuevaPosicion = $tecnico_fila->turno;
				break;
			}
		}
		if($nuevaPosicion == $turnoInicial)
		{
			foreach ($tecnicos as $tecnico_fila)
			{
				if($tecnico_fila->estado_tecnico_cola == '1')
				{
					$nuevaPosicion = $tecnico_fila->turno;
					break;
				}
			}
		}
		return $nuevaPosicion;
    }
    private function setEstadoSolicitud($solicitud, $estado){
    	$solicitud = Solicitud::findOrFail($solicitud);
    	$solicitud->update(['estado' => $estado]);
    }
    private function setCategoriaSolicitud($solicitud, $categoria){
    	$solicitud = Solicitud::findOrFail($id_solicitud);
    	$solicitud->update(['id_categoria' => $categoria]);
    }
    private function registarEvento($id_solicitud, $categoria, $tecnico, $detalle){
    	$evento = array('id_solicitud' => $id_solicitud,'id_categoria' => $categoria, 'id_tecnico' => $tecnico, 'detalle' => $detalle);
    	Evento::create($evento);
    }
    private function handleFile($file, $id_solicitud){
            $model = new Archivos();
            $ext = $file->getClientOriginalExtension();
            $filename = time().'.'.$file->getClientOriginalExtension();
    
            if ($file->move(public_path('upload'), $filename)) {
                return $model::create([
                        'nombre' => $file->getClientOriginalName(),
                        'path' => $filename,
                        'formato' => $ext,
                        'id_solicitud' => $id_solicitud,
                        'tipo' => 'SOL',
                        'id_evento' => 0,
                        'status' => 'activo',
                        'reg_del' => '0',
                        'user_mod' => 'UI',
                    ]);
            }else{
                throw new Exception("El archivo no se puede subir", 911, $e);
            }
    }
}
