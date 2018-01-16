<?php

namespace App;

use Idrd\Parques\Repo\Parque as MParque;

class Parque extends MParque
{
    /*public function parques()
	{
		return $this->hasMany(config('parques.modelo_parque'), 'Id_Tipo');
	}*/

	public function localidad (){
		return $this->belongsTo('App\Localidad', 'Id_Localidad');
	}
}
