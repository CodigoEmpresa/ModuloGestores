<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModificarTablaActividadgestor extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('actividad_gestor', function (Blueprint $table) {
            $table->string('Otro');
            $table->string('Observacion_Cancela');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::table('actividad_gestor', function (Blueprint $table) {
            $table->dropColum('Otro');
            $table->dropColum('Observacion_Cancela');
        });
    }
}
