<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GestorActividadEjetematica extends Model
{
    protected $table = 'actividadgestor_actividad_eje_tematica';
    protected $primaryKey = 'id';
    protected $fillable = ['actividad_gestor_id', 'eje_id', 'tematica_id', 'actividad_id'];
    protected $connection = '';

    public $timestamps = true;
    
    public function __construct()
  	{
  		$this->connection = config('connections.mysql');
  	}

  	public function GestorAcActividadGestortividadEjetematica()
    {
        return $this->belongsTo('App\ActividadGestor','actividad_gestor_id');
    }

    public function eje(){
        return $this->belongsTo('App\Eje', 'eje_id');
    }

    public function tematica(){
        return $this->belongsTo('App\Tematica', 'tematica_id');
    }

    public function actividad(){
        return $this->belongsTo('App\Actividad', 'actividad_id');
    }
}
