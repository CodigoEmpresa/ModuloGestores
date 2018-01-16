<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaNovedades extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        /*Schema::create('novedad', function (Blueprint $table) {
            $table->increments('Id');
            $table->integer('Id_Actividad_Gestor')->unsigned();
            $table->integer('Id_novedad');
            $table->string('Causa');
            $table->string('Accion');           

            $table->foreign('Id_Actividad_Gestor')->references('Id_Actividad_Gestor')->on('actividad_gestor')->onDelete('cascade');
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
       // Schema::drop('novedad');
    }
}
