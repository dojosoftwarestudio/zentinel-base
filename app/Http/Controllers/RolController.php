<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Rol;
use App\Http\Resources\RolResource;
class RolController extends Controller
{
    public function list()
    {
    	$list = Rol::all();
    	return response()->json(['data'=>RolResource::collection($list)],200);
    }
}
