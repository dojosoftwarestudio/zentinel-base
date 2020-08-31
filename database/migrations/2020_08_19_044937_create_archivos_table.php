<?php


use App\Settings\SettingsCommonsDatabase;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArchivosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('archivos', function (Blueprint $table) {
            SettingsCommonsDatabase::addId($table);
            $table->string('nombre', SettingsCommonsDatabase::getDefaultLength());
            $table->string('formato', SettingsCommonsDatabase::getDefaultLength());
            $table->text('path');
            $table->integer('id_solicitud');
            $table->integer('id_evento');
            $table->string('tipo',SettingsCommonsDatabase::getDefaultLength()); //solicitud, evento(repuesta)
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
        Schema::dropIfExists('archivos');
    }
}
