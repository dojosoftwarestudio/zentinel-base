<?php


use App\Settings\SettingsCommonsDatabase;

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Solicitud extends Migration
{
    public function up()
    {
        Schema::create('solicitudes', function (Blueprint $table) {
            SettingsCommonsDatabase::addId($table);
            $table->string('codigo',  SettingsCommonsDatabase::getCodeLength());
            $table->text('descripcion');
            $table->integer('id_user');
            $table->integer('id_tecnico')->nullable();
            $table->integer('id_categoria');
            $table->string('estado', SettingsCommonsDatabase::getDefaultLength());
            SettingsCommonsDatabase::addAuditFields($table);
            $table->timestamps();
        });
    }


    public function down()
    {
       Schema::dropIfExists('solicitudes');
    }
}
