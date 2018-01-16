<?php

namespace App;

use Idrd\Usuarios\Repo\Localidad as MLocalidad;

class Localidad extends MLocalidad
{

	public function personas()
    {
       return $this->belongsToMany('App\ActividadGestor','persona_localidad','id_localidad','id_persona');
    }
    public function ejecucion()
	{
		return $this->hasMany('App\Ejecucion', 'id_localidad');
	}
}