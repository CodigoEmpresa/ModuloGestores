<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaDatosActividad extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('datos_actividad',function(Blueprint $table){
                $table->increments('Id_Datos_Actividad');
                $table->integer('Id_Actividad')->unsigned();
                $table->bigInteger('Id_Eje');
                $table->bigInteger('Id_Tematica');
                $table->bigInteger('Id_Actividad_ET');
                $table->foreign('Id_Actividad')->references('Id_Actividad_Gestor')->on('actividad_gestor')->onDelete('cascade');;

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
         Schema::drop('datos_actividad');
    }
}
