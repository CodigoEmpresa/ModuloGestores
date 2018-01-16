<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Acceso extends Model
{
    protected $table = 'acceso';
    protected $primaryKey = 'Id_Persona';
    protected $fillable = ['Usuario', 'Contrasena'];
    protected $connection = '';

    public $timestamps = false;
    
    public function __construct()
    {
        $this->connection = 'db_principal';
    }
}
