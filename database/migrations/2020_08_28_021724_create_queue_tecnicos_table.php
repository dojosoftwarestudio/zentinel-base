<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Settings\SettingsCommonsDatabase;

class CreateQueueTecnicosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('queue_tecnicos', function (Blueprint $table) {
            SettingsCommonsDatabase::addId($table);
            $table->integer('turno');
            $table->integer('estado_tecnico_cola');
            $table->integer('id_cola');
            $table->integer('id_tecnico');
            SettingsCommonsDatabase::addAuditFields($table);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('queue_tecnicos');
    }
}

