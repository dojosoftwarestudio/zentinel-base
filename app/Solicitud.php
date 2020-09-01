<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Solicitud extends Model
{
    protected $table = "solicitudes";
    protected $guarded = [];

	public function solicitante()
    {
        return $this->belongsTo(User::class, 'id_user','id');
    }
    public function tecnico()
    {
        return $this->belongsTo(User::class, 'id_tecnico','id');
    }
}
