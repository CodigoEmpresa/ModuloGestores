<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ActividadgestorPersona extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('actividadgestor_persona', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('persona_id')->unsigned();
            $table->foreign('persona_id')->references('Id_Persona')->on('Persona');
            $table->integer('actividad_gestor_id')->unsigned();
            $table->foreign('actividad_gestor_id')->references('Id_Actividad_Gestor')->on('actividad_gestor');
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
        Schema::drop('actividadgestor_persona');
    }
}
