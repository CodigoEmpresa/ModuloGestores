<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class ActividadGestor extends Model
{
      //

	use SoftDeletes;
	
  protected $table = 'actividad_gestor';
	protected $primaryKey = 'Id_Actividad_Gestor';
	protected $fillable = ['Id_Persona','Id_Responsable','Fecha_Ejecucion','Hora_Incial','Hora_Final','Localidad','Parque','Caracteristica_Lugar','Instit_Grupo_Comun','Caracteristica_Poblacion','Numero_Asistente','Hora_Implementacion','Nombre_Contacto','Rool_Comunidad','Telefono','Fecha_Registro','Estado','Estado_Ejecucion','Fecha_Registro_Ejecución','Otro'];
	protected $connection = ''; 


  	public function __construct()
  	{
  		$this->connection = config('connections.mysql');
  	}
	  public function datosActividad()
    {
        return $this->hasMany('App\DatosActividad','Id_Actividad');
    }
     public function actividadgestorActividadEjeTematica()
     {
         return $this->belongsToMany('App\ActividadGestor','actividadgestor_actividad_eje_tematica','actividad_gestor_id','eje_id','tematica_id','actividad_id','Otro', 'Kit', 'Cantidad_Kit');
     }
    public function localidad() 
    {
        return $this->belongsTo('App\Localidad', 'Localidad'); 
    }

    public function parque() 
    {
        return $this->belongsTo('App\Parque', 'Parque'); 
    }

    public function persona() 
    {
        return $this->belongsTo('App\Persona', 'Id_Responsable'); 
    }

    public function personaProgramador() 
    {
        return $this->belongsTo('App\Persona', 'Id_Persona'); 
    }
    public function ejecucion()
    {
        return $this->belongsToMany('App\ActividadGestor','ejecucion','Id_Actividad_Gestor','Id_Actividad_Gestor','Comunidad','Localidad','TipoEntidad','Tipo','Condicion','Situacion','F_0a5','M_0a5','F_6a12','M_6a12','F_13a17','M_13a17','F_18a26','M_18a26','F_27a59','M_27a59','F_60','M_60');
    }
    public function novedad()
    {
        return $this->belongsToMany('App\ActividadGestor','novedad','Id_Actividad_Gestor','Id_novedad','Causa','Accion');
    }
    public function calificaciomServicio()
    {
        return $this->hasMany('App\Calificacion_servicio','Id_Actividad_Gestor');
    }     

    public function GestorActividadEjetematica(){
        return $this->hasMany('App\GestorActividadEjetematica', 'actividad_gestor_id');
    }

    /*public function actividadPersona() {
        return $this->belongsToMany('App\Persona', config('idrdgov_sim_gestores').'actividadgestor_persona', 'actividad_gestor_id', 'persona_id');
    }*/

    public function actividadPersona() {
      return $this->hasMany('App\ActividadGestorPersona', 'persona_id');
        //return $this->belongsToMany('App\Persona', config('idrdgov_sim_gestores').'actividadgestor_persona', 'actividad_gestor_id', 'persona_id');
    }
}
