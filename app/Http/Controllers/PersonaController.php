<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Persona;
use App\Http\Resources\PersonaResource;

class PersonaController extends Controller
{
	public function list(){
		$list= Persona::all();
		return response()->json(['list' => PersonaResource::collection($list)],200);
	}
    public function store(Request $req){
    	$persona = Persona::create($req->all());
    	return response()->json(['persona' => PersonaResource($persona)],200);
    }
    public function show($id){
		$persona = Persona::findOrfail($id);
		return response()->json(['persona' =>new PersonaResource ($persona)],200);
    }
    public function update(Request $req){
    	$persona = Persona::findOrfail($req->id);
    	$persona->nombre = $req->nombre;
    	$persona->apellido_pat = $req->apellido_pat;
    	$persona->apellido_mat = $req->apellido_mat;
    	$persona->estado = $req->estado;
    	$persona->save();
    	return response()->json(['persona' => new PersonaResource($persona)],200);
    }
}
