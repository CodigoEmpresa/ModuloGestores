<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaEjecucion extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('ejecucion', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('Id_Actividad_Gestor')->unsigned();
            $table->string('Comunidad');
            $table->integer('Localidad')->unsigned();
            $table->integer('TipoEntidad')->unsigned();
            $table->integer('Tipo')->unsigned();
            $table->integer('Condicion')->unsigned();
            $table->integer('Situacion')->unsigned();
            $table->integer('F_0a5');
            $table->integer('M_0a5');
            $table->integer('F_6a12');
            $table->integer('M_6a12');
            $table->integer('F_13a17');
            $table->integer('M_13a17');
            $table->integer('F_18a26');
            $table->integer('M_18a26');
            $table->integer('F_27a59');
            $table->integer('M_27a59');
            $table->integer('F_60');
            $table->integer('M_60');            

            $table->foreign('Id_Actividad_Gestor')->references('Id_Actividad_Gestor')->on('actividad_gestor')->onDelete('cascade');
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
        //
        Schema::drop('ejecucion');
    }
}
