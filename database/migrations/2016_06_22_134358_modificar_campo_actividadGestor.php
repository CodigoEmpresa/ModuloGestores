<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModificarCampoActividadGestor extends Migration
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
            $table->time('Hora_Incial')->change();
            $table->time('Hora_Final')->change();
            $table->time('Hora_Implementacion')->change();
            $table->dateTime('Fecha_Registro')->change();
            $table->text('Caracteristica_Lugar')->change();
            $table->text('Instit_Grupo_Comun')->change();
            $table->text('Caracteristica_Poblacion')->change();
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
             $table->dateTime('Hora_Incial')->change();
             $table->dateTime('Hora_Final')->change();
             $table->dateTime('Hora_Implementacion')->change();
             $table->string('Caracteristica_Lugar')->change();
             $table->string('Instit_Grupo_Comun')->change();
             $table->string('Caracteristica_Poblacion')->change();
        });
    }
}
