<?php

namespace App\Models\SIRIN;

use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
    protected $table = 'persona';
    protected $fillable = [
    	'id', 'nombre', 'apellido_pat','apellido_mat','estado','created_at','status', 'reg_del', 'user_mod'
    ];
}
