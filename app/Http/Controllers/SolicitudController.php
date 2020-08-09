<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Solicitud;
use App\Evento;
use App\Http\Requests\ProductCreateRequest;

class SolicitudController extends Controller
{
	public function list(){
		$list = Solicitud::all();
		return response()->json(['list'=> $list],200);
	}
	public function listBy(Request $req){
		$filter = $req->filter;
		$value = $req->value;
		$list = Solicitud::where($filter, $value)->get();
		return response()->json(['list'=> $list],200);
	}
	public function listTecnico($id){
		$list = Solicitud::where('id_tecnico', $id)->where('estado', '1')->get();
		return response()->json(['list'=> $list],200);
	}
	public function listSolicitados($id){
		$list = Solicitud::where('id_user', $id)->where('estado', '1')->get();
		return response()->json(['list'=> $list],200);
	}
	public function show($id){
		$solicitud = Solicitud::findOrfail($id);
		$eventos = Evento::where('id_solicitud', $id)->get();
		return response()->json(['solicitud'=> $solicitud, 'eventos' => $eventos],200);
	}
    public function store(Request $req){
    	$codigo = 'SINC-'.date("dmYHis");
    	$req->request->add(['codigo' => $codigo]);
    	$solicitud = Solicitud::create($req->all());
    	$evento = $this->asignar($solicitud->id, $solicitud->id_categoria);
    	$solicitud = Solicitud::findOrFail($solicitud->id);
    	return response()->json(['solicitud'=> $solicitud,'evento'=>$evento], 200);
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
 	private function asignar($solicitud, $categoria, $detalle = 'asignado por el sistema'){
    	//PREVIO SE DEBE HACER LA LOGICA DE SELECCION DEL TECNICO
    	$tecnico = 2;
    	Solicitud::where('id', $solicitud)->update(['id_tecnico' => $tecnico]);
		$this->registarEvento($solicitud, $categoria, $tecnico, $detalle);
    	// SEND MAIL TO TECNICO
    	$this->setEstadoSolicitud($solicitud, 1);
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
}
