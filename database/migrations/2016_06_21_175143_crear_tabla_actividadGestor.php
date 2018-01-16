<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaActividadGestor extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('actividad_gestor', function (Blueprint $table) {
            $table->increments('Id_Actividad_Gestor');
            $table->bigInteger('Id_Persona');
            $table->bigInteger('Id_Responsable');
            $table->date('Fecha_Ejecución');
            $table->dateTime('Hora_Incial');
            $table->dateTime('Hora_Final');
            $table->bigInteger('Localidad');
            $table->bigInteger('Parque');
            $table->string('Caracteristica_Lugar');
            $table->string('Instit_Grupo_Comun');
            $table->string('Caracteristica_Poblacion');
            $table->bigInteger('Numero_Asistente');
            $table->dateTime('Hora_Implementacion');
            $table->string('Nombre_Contacto');
            $table->string('Rool_Comunidad');
            $table->string('Telefono');
            $table->date('Fecha_Registro');
            $table->string('Estado');
            $table->string('Estado_Ejecucion');
            $table->date('Fecha_Registro_Ejecución');
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
        Schema::drop('actividad_gestor');
    }
}
