<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Solicitud extends Model
{
	protected $table = "solicitudes";

	protected $fillable = ['id','codigo','descripcion', 'id_user', 'id_tecnico','estado', 'id_categoria'];
}
