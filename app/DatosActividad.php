<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DatosActividad extends Model
{
    //
    protected $table = 'datos_actividad';
	protected $primaryKey = 'Id_Datos_Actividad';
	protected $fillable = ['Id_Actividad', 'Id_Eje','Id_Tematica','Id_Actividad_ET'];
	protected $connection = ''; 
	public $timestamps = false;


	public function __construct()
	{
		$this->connection = config('connections.mysql');
	}

	public function actividad_gestor2() {
        return $this->belongsTo('App\ActividadGestor', 'Id_Actividad'); 
    }
}
