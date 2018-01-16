<?php



namespace App;



use Illuminate\Database\Eloquent\Model;



class ListaNovedad extends Model

{

    //

    protected $table = 'listanovedad';

	protected $primaryKey = 'Id';

	protected $fillable = ['Nombre'];

	protected $connection = ''; 

	public $timestamps = false;



	public function __construct()

	{

		$this->connection = config('connections.mysql');

	}

}

