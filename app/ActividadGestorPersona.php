<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ActividadGestorPersona extends Model
{	
  	protected $table = 'actividadgestor_persona';
	protected $primaryKey = 'id';
	protected $fillable = ['persona_id','actividad_gestor_id'];
	protected $connection = ''; 
}
