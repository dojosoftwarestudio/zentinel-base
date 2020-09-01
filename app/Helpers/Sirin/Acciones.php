<?php

namespace App\Helpers\Sirin;
use App\Solicitud;
use App\Evento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Http\Resources\SolicitudResource as SolicitudResources;
use App\Mail\MessageRecevied;

class  Acciones
{
    public function __construct()
    {
    }
    public function asignacionAutomatica($idSolicitud, $colaCategoria, $detalle = 'Message Helper'){
        $tecnico = DB::table('queue_tecnicos')->where('id_cola', $colaCategoria->id)->where('turno', $colaCategoria->turno)->first();
        Solicitud::where('id', $idSolicitud)->update(['id_tecnico' => $tecnico->id]);
        $this->registarEvento($idSolicitud, $colaCategoria->id, $tecnico->id, $detalle);
        $nuevaPosicion = $this->siguienteCola($colaCategoria->id, $colaCategoria->turno, $tecnico->id);
        DB::table('queues')->where('id', $colaCategoria->id)->update(['turno'=> $nuevaPosicion]);
        // SEND MAIL TO TECNICO
        $solicitudMail = new SolicitudResources(Solicitud::findOrFail($idSolicitud));
        Mail::to('email@email.com')->queue(new MessageRecevied($solicitudMail));
        $this->setEstadoSolicitud($idSolicitud, 2);
    }
    public function asignacionTecnico($idSolicitud, $idCategoria,$idTecnico, $detalle = 'Message Helper'){
        Solicitud::where('id', $idSolicitud)->update(['id_tecnico' => $idTecnico]);
        $this->registarEvento($idSolicitud, $idCategoria, $idTecnico, $detalle);
        // SEND MAIL TO TECNICO
        $solicitudMail = new SolicitudResources(Solicitud::findOrFail($idSolicitud));
        Mail::to('email@email.com')->queue(new MessageRecevied($solicitudMail));
        $this->setEstadoSolicitud($idSolicitud, 2);
    }
    public function registarEvento($id_solicitud, $categoria, $tecnico, $detalle){
    	$evento = array('id_solicitud' => $id_solicitud,'id_categoria' => $categoria, 'id_tecnico' => $tecnico, 'detalle' => $detalle);
    	Evento::create($evento);
    }
    public function siguienteCola($colaActual, $turnoActual, $tecnicoActual){
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
    public function setEstado(Request $req){
    	$id_solicitud = $req->id;
    	$estado = $req->estado;
    	$tecnico = $req->id_tecnico;
    	$detalle = $req->descripcion;

    	$this->setEstadoSolicitud($id_solicitud, $estado);
    	$solicitud = Solicitud::findOrFail($id_solicitud);

    	$this->registarEvento($id_solicitud, $solicitud->id_categoria, $tecnico, $detalle);

    	return response()->json(['msg' =>'OK'], 200);
    }
    private function setEstadoSolicitud($solicitud, $estado){
    	$solicitud = Solicitud::findOrFail($solicitud);
    	$solicitud->update(['estado' => $estado]);
    }
}
