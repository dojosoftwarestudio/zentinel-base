<?php

namespace App\Models\SIRIN;

use Illuminate\Database\Eloquent\Model;

class Archivos extends Model
{
	protected $table = 'archivos';
	protected $fillable = ['id', 'nombre','path', 'formato', 'tipo', 'id_solicitud', 'id_evento', 'created_at','status', 'reg_del', 'user_mod'];
}
