<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Solicitud extends Migration
{
    public function up()
    {
        Schema::create('solicitudes', function (Blueprint $table) {
            $table->id();
            $table->string('codigo');
            $table->string('descripcion');
            $table->string('id_user');
            $table->string('id_tecnico')->nullable();
            $table->string('id_categoria');
            $table->string('estado');
            $table->timestamps();
        });
    }


    public function down()
    {
       Schema::dropIfExists('solicitudes');
    }
}
