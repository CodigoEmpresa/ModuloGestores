<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Eje extends Model
{
    protected $table = 'eje';
	protected $primaryKey = 'Id_Eje';
	protected $fillable = ['Nombre_Eje'];
	protected $connection = ''; 
	public $timestamps = false;

	public function __construct()
	{
		$this->connection = config('connections.mysql');
	}

	public function tematica()
	{
		return $this->hasMany('App\Tematica', 'Id_Eje');
	}

}
