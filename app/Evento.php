<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class Evento extends Model
{
	protected $table = "eventos";
	protected $fillable = ['id_solicitud', 'id_tecnico','detalle','id_categoria'];

}