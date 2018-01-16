<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaActividad extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('actividad', function (Blueprint $table) {
            $table->increments('Id_Actividad');
            $table->string('Nombre_Actividad');
            $table->integer('Id_Tematica')->unsigned();
            $table->foreign('Id_Tematica')->references('Id_Tematica')->on('tematica')->onDelete('cascade');
  
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
          Schema::drop('actividad');
    }
}
