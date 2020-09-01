<?php

namespace App\Http\Controllers;
use App\Solicitud;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Helpers\Sirin\Acciones;
class TecnicoController extends Controller
{
    public function derivar(Request $req){
        $req->validate([
            'id' => 'required',
            'descripcion' => 'required',
            'id_categoria' => 'required'
        ]);
        $asignacion = new Acciones();
        $msg = '';
        if($req->id_tecnico != null){
           $asignacion->asignacionTecnico($req->id, $req->id_categoria, $req->id_tecnico,  $req->descripcion);
           Solicitud::where('id', $req->id)->update(['id_categoria' =>  $req->id_categoria]);
           $msg = 'Asignado al tecnico exitosamente';
        }else{
            $colaCategoria = DB::table('queues')->where('id_categoria', $req->id_categoria)->first();
            $asignacion->asignacionAutomatica($req->id, $colaCategoria, $req->descripcion);
            Solicitud::where('id', $req->id)->update(['id_categoria' =>  $req->id_categoria]);
            $msg = 'Recategorizada exitosamente';
        }
        return response()->json(['msg' => $msg], 200);
    }
    public function recategorizar(Request $req){
        $msg = '';
        $req->validate([
            'id' => 'required',
            'descripcion' => 'required',
            'id_categoria' => 'required'
        ]);
        $asignacion = new Acciones();
        $colaCategoria = DB::table('queues')->where('id_categoria', $req->id_categoria)->first();
        $asignacion->asignacionAutomatica($req->id, $colaCategoria, $req->descripcion);
        Solicitud::where('id', $req->id)->update(['id_categoria' =>  $req->id_categoria]);
        $msg = 'Recategorizada exitosamente';
        return response()->json(['msg' => $msg], 200);
    }
    public function rechazar(Request $req){
        $msg = '';
        $req->validate([
            'id' => 'required',
            'descripcion' => 'required',
            'id_tecnico' =>'required'
        ]);
        $req->request->add(['estado' => 4]);
        $asignacion = new Acciones();

        $res = $asignacion->setEstado($req);
        return $res;
    }
    public function finalizar(Request $req){
        $msg = '';
        $req->validate([
            'id' => 'required',
            'descripcion' => 'required',
            'id_tecnico' => 'required'
        ]);
        $req->request->add(['estado' => 5]);
        $acciones = new Acciones();

        $res = $acciones->setEstado($req);
        return $res;
    }
}
