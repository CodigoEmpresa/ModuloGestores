<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModificarTablaActividadGestor extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
     public function up()
    {
        //Lo nuevo
        Schema::table('actividad_gestor',function (Blueprint $table) {
            $table->renameColumn('Fecha_Ejecución','Fecha_Ejecucion');

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
        Schema::table('actividad_gestor',function(Blueprint $table){
             $table->renameColumn('Fecha_Ejecucion','Fecha_Ejecución');
        });
    }
}
