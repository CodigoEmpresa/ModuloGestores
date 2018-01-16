<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaCalificacionServicio extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('calificacion_servicio', function (Blueprint $table) {
            $table->increments('Id');
            $table->integer('Id_Actividad_Gestor')->unsigned();
            $table->integer('Id_Puntualidad');
            $table->integer('Id_Divulgacion');
            $table->integer('Id_Montaje');
            $table->integer('Id_Cumplimiento');
            $table->integer('Id_Variedad');
            $table->integer('Id_Seguridad');
            $table->string('Nombre_Representante');
            $table->string('Telefono');
            $table->string('Url_Imagen1');
            $table->string('Url_Imagen2');
            $table->string('Url_Imagen3');
            $table->string('Url_Imagen4');
            $table->string('Url_Asistencia');
            $table->string('Url_Acta');
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
        Schema::drop('calificacion_servicio');
    }
}
