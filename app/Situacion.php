<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Situacion extends Model
{
    //
    protected $table = 'situacion';
	protected $primaryKey = 'Id';
	protected $fillable = ['Nombre'];
	protected $connection = ''; 
	public $timestamps = false;

	public function __construct()
	{
		$this->connection = config('connections.mysql');
	}
	public function ejecucion()
	{
		return $this->hasMany('App\Ejecucion', 'Id');
	}
}
