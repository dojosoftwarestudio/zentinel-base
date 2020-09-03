<?php

namespace App\Models\SIRIN;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = "categorias";
    protected $fillable = [
    	'id', 'nombre', 'descripcion', 'prioridad', 'is_public','created_at','status', 'reg_del', 'user_mod'
    ];
}
