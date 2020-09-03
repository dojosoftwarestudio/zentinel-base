<?php

namespace App\Models\SIRIN;

use Illuminate\Database\Eloquent\Model;

class Rol extends Model
{
    protected $table = "rols";
    protected $fillable = ['name', 'created_at','status', 'reg_del', 'user_mod'];
}
