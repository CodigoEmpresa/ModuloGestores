<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Calificacion_servicio extends Model
{
    //
    protected $table = 'calificacion_servicio';
	protected $primaryKey = 'Id';
	protected $fillable = ['Id_Actividad_Gestor','Id_Puntualidad','Id_Divulgacion','Id_Montaje','Id_Cumplimiento','Id_Variedad','Id_Seguridad','Nombre_Representante','Telefono','Url_Imagen1','Url_Imagen2','Url_Imagen3','Url_Imagen4','Url_Asistencia','Url_Acta'];
	protected $connection = ''; 
	public $timestamps = false;

	public function __construct()
	{
		$this->connection = config('connections.mysql');
	}
	public function actividad_gestor() {
        return $this->belongsTo('App\ActividadGestor', 'Id_Actividad_Gestor'); 
    } 
}
