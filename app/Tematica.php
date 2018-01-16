<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tematica extends Model
{
    //
    protected $table = 'tematica';
	protected $primaryKey = 'Id_Tematica';
	protected $fillable = ['Nombre_Tematica','Id_Eje'];
	protected $connection = ''; 
	public $timestamps = false;

	public function __construct()
	{
		$this->connection = config('connections.mysql');
	}
	public function actividad()
	{
		return $this->hasMany('App\Actividad', 'Id_Tematica');
	}
	public function eje()
	{
		return $this->belongsTo('App\Eje', 'Id_Eje');
	}
}
