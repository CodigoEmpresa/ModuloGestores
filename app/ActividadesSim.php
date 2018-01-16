<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ActividadesSim extends Model
{
    protected $table = 'actividades';
    protected $primaryKey = 'Id_Actividad';
    protected $fillable = ['Id_Modulo', 'Nombre_Actividad', 'Descripcion'];
    protected $connection = '';

    public $timestamps = false;
    
    public function __construct()
    {
        $this->connection = 'db_principal';
    }

    public function persona()
	{
		return $this->belongsToMany('App\Persona', 'actividad_acceso', 'Id_Actividad', 'Id_Persona');
	}

	public function modulo()
	{
		return $this->belongsTo('App\Modulo', 'Id_Modulo');
	}
}
