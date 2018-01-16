<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ejecucion extends Model
{
	//
    protected $table = 'ejecucion';
	protected $primaryKey = 'Id';
	protected $fillable = ['Id_Actividad_Gestor','Comunidad','Localidad','TipoEntidad','Tipo','Condicion','Situacion','F_0a5','M_0a5','F_6a12','M_6a12','F_13a17','M_13a17','F_18a26','M_18a26','F_27a59','M_27a59','F_60','M_60'];
	protected $connection = ''; 
	public $timestamps = false;

	public function __construct()
	{
		$this->connection = config('connections.mysql');
	}
	
	public function actividad_gestor() {
        return $this->belongsTo('App\ActividadGestor', 'Id_Actividad_Gestor'); 
    }

    public function tipoEntidad() {
    	return $this->belongsTo('App\TipoEntidad','TipoEntidad');
    }
    public function tipoPersona() {
    	return $this->belongsTo('App\TipoPersona','Tipo');
    }
    public function condicion() {
    	return $this->belongsTo('App\Condicion','Condicion');
    }
    public function situacion() {
    	return $this->belongsTo('App\Situacion','Situacion');
    }
    public function localidad() {
        return $this->belongsTo('App\Localidad','Localidad');
    }
}
