<?php

namespace App;

use Idrd\Usuarios\Repo\Tipo as MTipo;

class Tipo extends MTipo
{
    public function TipoModulo() {
        return $this->belongsTo('App\Modulo', 'Id_Modulo'); 
    }         
}