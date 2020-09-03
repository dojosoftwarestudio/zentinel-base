<?php

namespace App\Models\SIRIN;
use Illuminate\Database\Eloquent\Model;

class Estado extends Model
{
    protected $table = 'estados';
    protected $fillable = ['id', 'codigo', 'descripcion', 'created_at','status', 'reg_del', 'user_mod'];
}
