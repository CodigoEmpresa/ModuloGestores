<?php

return array( 
 
  'conexion' => 'db_principal', 
   
  'prefijo_ruta' => 'personas', 
  'modelo_persona' => 'App\Persona', 
  'modelo_documento' => 'App\Documento', 
  'modelo_pais' => 'App\Pais', 
  'modelo_ciudad' => 'App\Ciudad', 
  'modelo_genero' => 'App\Genero', 
  'modelo_etnia' => 'App\Etnia', 
  'modelo_tipo' => 'App\Tipo',
  
   
  //vistas que carga las vistas 
  'vista_lista' => 'list', 
 
  //lista 
  'lista'  => 'idrd.usuarios.lista', 
);