<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ActividadgestroActividadEjeTematica extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
      /*  Schema::create('actividadgestor_actividad_eje_tematica', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('actividad_gestor_id')->unsigned();
            $table->foreign('actividad_gestor_id')->references('Id_Actividad_Gestor')->on('actividad_gestor');
            $table->integer('eje_id')->unsigned();
            $table->foreign('eje_id')->references('Id_Eje')->on('Eje');
            $table->integer('tematica_id')->unsigned();
            $table->foreign('tematica_id')->references('Id_Tematica')->on('Tematica');
            $table->integer('actividad_id')->unsigned();
            $table->foreign('actividad_id')->references('Id_Actividad')->on('Actividad');
            $table->timestamps();
        });*/
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::drop('actividadgestor_actividad_eje_tematica');
    }
}
