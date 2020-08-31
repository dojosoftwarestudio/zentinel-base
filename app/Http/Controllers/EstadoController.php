<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Estado;

use App\Http\Resources\EstadoResource;

class EstadoController extends Controller
{
    public function list(){
    	$list = Estado::all();
    	return response()->json(['list' => EstadoResource::collection($list)],200);
    }
    public function store(Request $req){
    	$estado = Estado::create($req->all());
    	return response()->json(['estado' => new EstadoResource($estado)],200);
    }
    public function update(Request $req){
    	$estado = Estado::findOrFail($req->id);
    	$estado->save();
    	return response()->json(['updated' => $estado],200);
    }
    public function show($id){
    	$estado = Estado::findOrFail($id);
		return response()->json(['estado' => $estado],200);
    }
    public function delete(){
    }
}
