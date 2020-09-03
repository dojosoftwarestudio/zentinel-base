<?php

namespace App\Http\Controllers\SIRIN;

use App\Http\Controllers\Controller;

use App\Rol;
use App\Http\Resources\SIRIN\RolResource;
class RolController extends Controller
{
    public function list()
    {
    	$list = Rol::all();
    	return response()->json(['data'=>RolResource::collection($list)],200);
    }
}
