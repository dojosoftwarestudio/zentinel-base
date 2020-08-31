<?php

use App\Settings\SettingsCommonsDatabase;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePersonasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('personas', function (Blueprint $table) {
            SettingsCommonsDatabase::addId($table);
            $table->string('nombre', SettingsCommonsDatabase::getDefaultLength());
            $table->string('apellido_pat', SettingsCommonsDatabase::getDefaultLength());
            $table->string('apellido_mat', SettingsCommonsDatabase::getDefaultLength());
            $table->string('estado', 1);
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
        Schema::dropIfExists('personas');
    }
}
