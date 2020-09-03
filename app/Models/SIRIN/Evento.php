<?php
namespace App\Models\SIRIN;

use Illuminate\Database\Eloquent\Model;

class Evento extends Model
{
	protected $table = "eventos";

	protected $fillable = ['id_solicitud', 'id_tecnico','detalle','id_categoria','status', 'reg_del', 'user_mod'];

}
