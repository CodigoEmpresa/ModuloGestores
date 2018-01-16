<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Novedad extends Model
{
    //
	protected $table = 'novedad';
	protected $primaryKey = 'Id';
	protected $fillable = ['Id_Actividad_Gestor','Id_novedad','Causa','Accion'];
	protected $connection = ''; 
	public $timestamps = false;

	public function __construct()
	{
		$this->connection = config('connections.mysql');
	}
	public function actividad_gestor() {
        return $this->belongsTo('App\ActividadGestor', 'Id_Actividad_Gestor'); 
    }     

    public function listaNovedad() {
    	return $this->belongsTo('App\ListaNovedad','Id_novedad');
    }    
}
