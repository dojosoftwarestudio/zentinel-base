<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = "categoria";
    protected $fillable = [
    	'id', 'nombre', 'descripcion', 'prioridad', 'created_at'
    ];
}
