<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaTematica extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('tematica', function (Blueprint $table) {
            $table->increments('Id_Tematica');
            $table->string('Nombre_Tematica');
            $table->integer('Id_Eje')->unsigned();
            $table->foreign('Id_Eje')->references('Id_Eje')->on('eje')->onDelete('cascade');
  
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
          Schema::drop('tematica');
    }
}
