<?php



namespace App\Http\Controllers;



use Illuminate\Http\Request;

use App\Http\Requests;

use App\ActividadGestor;

use App\DatosActividad;

use App\Persona;

use Validator;



use App\Tipo;

use App\ActividadesSim;

use App\ActividadAcceso;

use App\GestorActividadEjetematica;



use App\ActividadGestorPersona;





class ConfiguracionActividadController extends Controller

{

    //



    public function __construct(){

       if (isset($_SESSION['Usuario']))

           $this->Usuario = $_SESSION['Usuario'];

   }



	public function buscarTematicas(Request $request, $id_eje)

	{

		$eje_model = app()->make('App\Eje');

		$eje = $eje_model->find($id_eje);

		return response()->json($eje->tematica);

	}



	//

	public function buscarActividades(Request $request, $id_tematica)

	{

		$tematica_model_ = app()->make('App\Tematica');

		$actividad = $tematica_model_->find($id_tematica);



		return response()->json($actividad->actividad);

	}



	public function buscarEje(Request $request, $id_eje)

	{

		$eje_model = app()->make('App\Eje');

		$eje = $eje_model->find($id_eje);



		return response()->json($eje);

	}



	public function buscarTematica(Request $request, $id_tematica)

	{

		$eje_model = app()->make('App\Tematica');

		$eje = $eje_model->find($id_tematica);



		return response()->json($eje);

	}



	public function buscarActividad(Request $request, $id_actividad)

	{

		$eje_model = app()->make('App\Actividad');

		$eje = $eje_model->find($id_actividad);



		return response()->json($eje);

	}



	 public function procesarValidacion(Request $request)

	{

		$validator = Validator::make($request->all(),

		    [	           

				'Fecha_Ejecucion' => 'required',

				'Id_Responsable' => 'required',

				'Hora_Inicio' => 'required',

				'Hora_Fin' => 'required',

				'Id_Localidad' => 'required',

				'Parque' => 'required',

				'Caracteristica_Lugar' => 'required',

				'Caracteristica_poblacion' => 'required',

				'Institucion_Grupo' => 'required',

				'Numero_Asistentes' => 'required|numeric',

				'Hora_Implementacion' => 'required',

				'Persona_Contacto' => 'required',

				'Roll_Comunidad' => 'required',

				'Telefono' => 'required',

				'Id_Eje' => 'required',

				'Id_Tematica' => 'required',

				'd_Actividad' => 'required',

				'otro_Actividad' => array('required_if:d_Actividad,4,20,13,19'),

				'Kit' => 'required',

				'Cantidad_Kit' => array('required_if:Kit,1'),

        	]

        );



        if ($validator->fails())

            return response()->json(array('status' => 'error', 'errors' => $validator->errors()));



        	if($request->input('Id_Actividad') == '0')

        	$this->guardar($request->all());

        	else

        	$this->modificar($request->all());



        return response()->json(array('status' => 'ok'));

	}



	public function guardar($input)

	{

		$model_A = new ActividadGestor;

		return $this->crear_actividad($model_A, $input);

	}



	public function modificar($input)

	{

		

		$modelo=ActividadGestor::find($input["Id_Actividad"]);



		return $this->modificar_actividad($modelo, $input);

	}



	public function crear_actividad($model, $input)

	{

		$model['Id_Persona'] = $_SESSION['Usuario'][0];

		$model['Id_Responsable'] = $input['Id_Responsable'];

		$model['Fecha_Ejecucion'] = $input['Fecha_Ejecucion'];

		$model['Hora_Incial'] = $input['Hora_Inicio'];

		$model['Hora_Final'] = $input['Hora_Fin'];

		$model['Localidad'] = $input['Id_Localidad'];

		$model['Parque'] = $input['Parque'];

		$model['Otro'] = $input['otro_Parque'];

		$model['Caracteristica_Lugar'] = $input['Caracteristica_Lugar'];

		$model['Instit_Grupo_Comun'] = $input['Institucion_Grupo'];

		$model['Caracteristica_Poblacion'] = $input['Caracteristica_poblacion'];

		$model['Numero_Asistente'] = $input['Numero_Asistentes'];

		$model['Hora_Implementacion'] = $input['Hora_Implementacion'];

		$model['Nombre_Contacto'] = $input['Persona_Contacto'];

		$model['Rool_Comunidad'] = $input['Roll_Comunidad'];

		$model['Telefono'] = $input['Telefono'];

		$model['Fecha_Registro'] = date("Y-m-d G:i:s");

		$model['Estado'] = '2';

		$model['Estado_Ejecucion'] = '1';



		$model->save();

		$id_act_gest=$model->Id_Actividad_Gestor;



		$actividadgestorActividadEjeTematica = new GestorActividadEjetematica;

		$actividadgestorActividadEjeTematica->actividad_gestor_id = $id_act_gest;

		$actividadgestorActividadEjeTematica->eje_id = $input['Id_Eje'];

		$actividadgestorActividadEjeTematica->tematica_id = $input['Id_Tematica'];

		$actividadgestorActividadEjeTematica->actividad_id = $input['d_Actividad'];

		$actividadgestorActividadEjeTematica->Otro = $input['otro_Actividad'];

		$actividadgestorActividadEjeTematica->Kit = $input['Kit'];

		$actividadgestorActividadEjeTematica->Cantidad_Kit = $input['Cantidad_Kit'];

		$actividadgestorActividadEjeTematica->save();



		

		$data1 = json_decode($input['Personas_Acompanates']);

		foreach($data1 as $obj1){

			$idPerosna=$obj1->acompa;

			$model_P = Persona::with('actividadGestor')->find($idPerosna);

			$model_P->actividadGestor()->attach($id_act_gest);

		}



		$ActividadGestorPersona = new ActividadGestorPersona;

		$ActividadGestorPersona->persona_id = $id_act_gest;

		$ActividadGestorPersona->actividad_gestor_id = $input['Id_Responsable'];

		$ActividadGestorPersona->save();

		

		return $model;

	}





	public function modificar_actividad($model, $input)

	{		

		$model['Fecha_Ejecucion'] = $input['Fecha_Ejecucion'];

		$model['Hora_Incial'] = $input['Hora_Inicio'];

		$model['Hora_Final'] = $input['Hora_Fin'];

		$model['Localidad'] = $input['Id_Localidad'];

		$model['Parque'] = $input['Parque'];

		$model['Otro'] = $input['otro_Parque'];

		$model['Caracteristica_Lugar'] = $input['Caracteristica_Lugar'];

		$model['Instit_Grupo_Comun'] = $input['Institucion_Grupo'];

		$model['Caracteristica_Poblacion'] = $input['Caracteristica_poblacion'];

		$model['Numero_Asistente'] = $input['Numero_Asistentes'];

		$model['Hora_Implementacion'] = $input['Hora_Implementacion'];

		$model['Nombre_Contacto'] = $input['Persona_Contacto'];

		$model['Rool_Comunidad'] = $input['Roll_Comunidad'];

		$model['Telefono']= $input['Telefono'];



		$model->save();

		return $model;

	}









// PERSONA LOCALIDAD



	 public function asignarLocalidad(){

        $Tipo = app()->make('App\Tipo');

        $Localidad = app()->make('App\Localidad');

        $datos = [

            'Tipo' => $Tipo->find(46),            

            'localidad' => $Localidad->all()

        ];

       

        return view('perosona_localidad', $datos);

    }



    public function procesarValidacionPersonaLocalidad(Request $request)

	{

		$validator = Validator::make($request->all(),

		    [

				'Id_Persona' => 'required',

				'Id_Localidad' => 'required'

        	]

        );



        if ($validator->fails()){

            return response()->json(array('status' => 'error', 'errors' => $validator->errors()));

        }else{

        	

        	return $this->creaRelacionLocalidad($request->all());

        }



	}



	public function verPersonaLocalidad()

	{

		$personas = Persona::with('localidades')->has('localidades')->get();

		return $personas;

	}



	public function creaRelacionLocalidad($input)

	{

		$id_persona = $input['Id_Persona'];

		$id_localidad= $input['Id_Localidad'];

		$model_P = Persona::with('localidades')->find($id_persona);

		$model_P->localidades()->attach($id_localidad);

		$personas = Persona::with('localidades')->has('localidades')->get();

		return $personas;

	}



	public function eliminaPersonaLocalidad(Request $request)

	{

		$id_persona = $request->idpersona;

		$id_localidad= $request->idlocalidad;

		$model_P = Persona::with('localidades')->find($id_persona);

		$model_P->localidades()->detach($id_localidad);

		$personas = Persona::with('localidades')->has('localidades')->get();

		return $personas;

	}





	 public function procesarModificacionValidacion(Request $request)

  {

  //	dd($request->all());

    $validator = Validator::make($request->all(),

        [             

        'Fecha_Ejecucion' => 'required',

        'Id_Responsable' => 'required',

        'Hora_Inicio' => 'required',

        'Hora_Fin' => 'required',

        'Id_Localidad' => 'required',

        'Parque' => 'required',

        'Caracteristica_Lugar' => 'required',

        'Caracteristica_poblacion' => 'required',

        'Institucion_Grupo' => 'required',

        'Numero_Asistentes' => 'required|numeric',

        'Hora_Implementacion' => 'required',

        'Persona_Contacto' => 'required',

        'Roll_Comunidad' => 'required',

        'Telefono' => 'required',

          ]

        );



        if ($validator->fails())

            return response()->json(array('status' => 'error', 'errors' => $validator->errors()));



          if($request->input('Id_Actividad') != '0')

          $this->modificar_act($request->all());



        return response()->json(array('status' => 'ok'));

  }



  public function modificar_act($input)

  {

    $modelo=ActividadGestor::find($input["Id_Actividad"]);

    return $this->modificar_actividad_2($modelo, $input);

  }

  public function modificar_actividad_2($model, $input)

  {



    

    //var_dump($model);

    $model['Id_Responsable'] = $input['Id_Responsable'];

    $model['Fecha_Ejecucion'] = $input['Fecha_Ejecucion'];

    $model['Hora_Incial'] = $input['Hora_Inicio'];

    $model['Hora_Final'] = $input['Hora_Fin'];

    $model['Localidad'] = $input['Id_Localidad'];

    $model['Parque'] = $input['Parque'];

    $model['Otro'] = $input['otro_Parque'];

    $model['Caracteristica_Lugar'] = $input['Caracteristica_Lugar'];

    $model['Instit_Grupo_Comun'] = $input['Institucion_Grupo'];

    $model['Caracteristica_Poblacion'] = $input['Caracteristica_poblacion'];

    $model['Numero_Asistente'] = $input['Numero_Asistentes'];

    $model['Hora_Implementacion'] = $input['Hora_Implementacion'];

    $model['Nombre_Contacto'] = $input['Persona_Contacto'];

    $model['Rool_Comunidad'] = $input['Roll_Comunidad'];

    $model->Telefono= $input['Telefono'];



    $model->save();

    

	/**********************************/

	$id_act_gest=$model->Id_Actividad_Gestor;	

$model->actividadgestorActividadEjeTematica()->where('actividad_gestor_id', $id_act_gest)->detach();



	$data0 = json_decode($input['Dato_Actividad']);

//dd($data0);

		foreach($data0 as $obj){

			if(!isset($obj->Cantidad_Kit)){

				$objCantidad_Kit = 0;

			}else{

				$objCantidad_Kit = $obj->Cantidad_Kit;

			}

			$model->actividadgestorActividadEjeTematica()->attach($id_act_gest,[

				'eje_id'=>$obj->id_eje,

				'tematica_id'=>$obj->id_tematica,

				'actividad_id'=>$obj->id_act,

				'Otro'=>$obj->otro_actividad,

				'Kit'=>$obj->Kit,

				'Cantidad_Kit'=>$objCantidad_Kit,

				]);

		}

	/**********************************/



    return $model;



    /*$model->save();

		$id_act_gest=$model->Id_Actividad_Gestor;

		$data0 = json_decode($input['Dato_Actividad']);

		//var_dump($data0);

		foreach($data0 as $obj){

			$model->actividadgestorActividadEjeTemat8ica()->attach($id_act_gest,[

				'eje_id'=>$obj->id_eje,

				'tematica_id'=>$obj->id_tematica,

				'actividad_id'=>$obj->id_act,

				'Otro'=>$obj->otro_actividad,

				'Kit'=>$obj->Kit,

				'Cantidad_Kit'=>$obj->Cantidad_Kit,

				]);

		}

*/

  }





    public function asignarTipoPersona(){

        return view('persona_tipoPersona');

    }



	public function tipoModulo(){

		$Tipo_Modulo = Tipo::join('modulo', 'tipo.Id_Modulo', '=', 'modulo.Id_Modulo')

					    	->where('tipo.Id_Modulo', '=', 30)

					    	->select('tipo.*')

					    	->get();

        return $Tipo_Modulo;

	}



	public function AdicionTipoPersona(Request $request){

		 $validator = Validator:: make($request->all(),[

            'Id' => 'required',

            'Id_Tipo' => 'required',

        ]);

        if ($validator->fails()) {

            return response()->json(["Bandera" => 0, "Mensaje" => ", pero ocurrio un error en la validación de la imagen o su tamaño."]);

        }else{        

			$Persona = Persona::find($request->Id);

			$Persona->tipo()->sync([$request->Id_Tipo]);

	        return response()->json(["Bandera" => 1, "Mensaje" => "Perfil añadido con éxito."]);

    	}

	}





	public function asignarActividades(){

        return view('persona_actividades');

    }



    public function moduloActividades(){

    	$Actividades = ActividadesSim::join('modulo', 'actividades.Id_Modulo', '=', 'modulo.Id_Modulo')

					    	->where('actividades.Id_Modulo', '=', 30)

					    	->select('actividades.*')

					    	->get();

    	return $Actividades;

	}



	public function personaActividades(Request $request, $id){

		$personaActividades = Persona::with('Actividades')->find($id);

		$actividades = $personaActividades->Actividades()->where('Id_Modulo', 30)->where('Estado', 1)->get();

		return $actividades;

	}



	public function PersonasActividadesProceso(Request $request){



		$accesoPersona = Persona::with('acceso')->find($request->Id);

		$i=0;

		if(isset($accesoPersona->acceso)){

			$persona = Persona::find($request->Id);

			foreach ($request->Datos as $datos) {

				if($datos['estado'] == 1){

					$aprobadas[$datos['id_actividad']] = array('estado' =>  1);

					$eliminar[$i] = $datos['id_actividad'];

				}else{

					$aprobadas[$datos['id_actividad']] = array('estado' =>  0);

					$eliminar[$i] = $datos['id_actividad'];

				}

				$i++;

			

			}

			$persona->Actividades()->detach($eliminar);

			$persona->Actividades()->attach($aprobadas);

				$Mensaje = 'Las acticvidades de '.$accesoPersona['Primer_Nombre'].' '.$accesoPersona['Segundo_Nombre'].' '.$accesoPersona['Primer_Apellido'].' '.$accesoPersona['Segundo_Apellido'].' han sido asignadas correctamente.';

				$Bandera = 1;

		}else{

			$Mensaje = 'Para asignar actividades a '.$accesoPersona['Primer_Nombre'].' '.$accesoPersona['Segundo_Nombre'].' '.$accesoPersona['Primer_Apellido'].' '.$accesoPersona['Segundo_Apellido'].', primero debe contar con acceso al SIM.';

			$Bandera = 0;

		}		

		return response()->json(["Mensaje" => $Mensaje, "Bandera" => $Bandera]);

	}

}