<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Estado extends Model
{
    protected $table = 'estado';
    protected $fillable = ['id', 'codigo', 'descripcion', 'created_at','status', 'reg_del', 'user_mod'];
}
