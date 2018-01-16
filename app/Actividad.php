<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Actividad extends Model
{
    //
    protected $table = 'actividad';
	protected $primaryKey = 'Id_Actividad';
	protected $fillable = ['Nombre_Actividad','Id_Tematica'];
	protected $connection = ''; 
	public $timestamps = false;

	public function __construct()
	{
		$this->connection = config('connections.mysql');
	}

	public function tematica()
	{
		return $this->belongsTo('App\Tematica', 'Id_Tematica');
	}
}
