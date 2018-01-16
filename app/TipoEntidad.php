<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TipoEntidad extends Model
{
    protected $table = 'tipo_entidad';
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
