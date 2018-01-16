<?php



namespace App\Http\Controllers;



use Illuminate\Http\Request;

use App\Http\Requests;

use Idrd\Usuarios\Repo\PersonaInterface;

use App\ActividadGestor;

use Illuminate\Support\Facades\DB;

use App\Parque;

use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Redirect;



class Actividadcontroller extends Controller

{





   protected $Usuario;

   protected $repositorio_personas;

   

   public function __construct(PersonaInterface $repositorio_personas){

       if (isset($_SESSION['Usuario']))

           $this->Usuario = $_SESSION['Usuario'];

           $this->repositorio_personas = $repositorio_personas;

   }



   public function show(Request $request){
    
    if ($request->has('vector_modulo'))
        {   
            $vector = urldecode($request->input('vector_modulo'));
            $user_array = unserialize($vector);

        
            $_SESSION['Usuario'] = $user_array;
            $persona = $this->repositorio_personas->obtener($_SESSION['Usuario'][0]);
            $_SESSION['Usuario']['Persona'] = $persona;
            $this->Usuario = $_SESSION['Usuario'];
        } else {
            if(!isset($_SESSION['Usuario']))
                $_SESSION['Usuario'] = '';
        }
        
        if ($_SESSION['Usuario'] == '')
            //return redirect()->away('http://www.idrd.gov.co/SIM/Presentacion/');


       // $deportista = $_SESSION['Usuario']['Persona'];

            $vector="a%3A10%3A%7Bi%3A0%3Bs%3A4%3A%221046%22%3Bi%3A1%3Bs%3A1%3A%221%22%3Bi%3A2%3Bs%3A1%3A%221%22%3Bi%3A3%3Bs%3A1%3A%221%22%3Bi%3A4%3Bs%3A1%3A%221%22%3Bi%3A5%3Bs%3A1%3A%221%22%3Bi%3A6%3Bs%3A1%3A%221%22%3Bi%3A7%3Bs%3A1%3A%221%22%3Bi%3A8%3Bs%3A1%3A%221%22%3Bi%3A9%3Bs%3A1%3A%221%22%3B%7D";
            //$vectorArreglaso = "a%3A9%3A%7Bi%3A0%3Bs%3A4%3A%221307%22%3Bi%3A1%3Bs%3A1%3A%221%22%3Bi%3A2%3Bs%3A1%3A%221%22%3Bi%3A3%3Bs%3A1%3A%221%22%3Bi%3A4%3Bs%3A1%3A%221%22%3Bi%3A5%3Bs%3A1%3A%221%22%3Bi%3A6%3Bs%3A1%3A%221%22%3Bi%3A7%3Bs%3A1%3A%221%22%3Bi%3A8%3Bs%3A1%3A%221%22%3B%7D";

            $vector = urldecode($vector);
            $user_array = unserialize($vector);       
            $_SESSION['Usuario'] = $user_array;
            
            $persona = $this->repositorio_personas->obtener($_SESSION['Usuario'][0]);
            $_SESSION['Usuario']['Persona'] = $persona;
          

            return view('welcome');

   }



    public function index(){



    $eje = app()->make('App\Eje');

		$tematica = app()->make('App\Tematica');

		$actividad = app()->make('App\Actividad');

		$Localidad = app()->make('App\Localidad');

		$Tipo = app()->make('App\Tipo');

		//$Parque = app()->make('App\Parque');

		//$TipoParque = app()->make('App\TipoParque');



		$datos = [

	        'eje' => $eje->all(),

	        'tematica' => $tematica->all(),

	        'actividad' => $actividad->all(),

	        'localidad' => $Localidad->all(),

	        'Tipo' => $Tipo->find(46),

	       // 'tipoparques' => $TipoParque->find(3),

			'status' => session('status')

		];

    	return view('crear_actividad', $datos);

    }

    public function Cerrar(){

       //Desconctamos al usuario

        Auth::logout();



        //Redireccionamos al inicio de la app con un mensaje

        return Redirect::to('../')->with('msg', 'Gracias por visitarnos!.');

    }



    public function MiActividad(){

      $eje = app()->make('App\Eje');

      $datosActividad = app()->make('App\ActividadGestor');

  		$PersonaActividad = app()->make('App\Persona');

  		$Tipo = app()->make('App\Tipo');

  		$Localidad = app()->make('App\Localidad');

  		$TipoParque = app()->make('App\TipoParque');

  		$datos = [

        'eje' => $eje->all(),

        'datosActividad' => $datosActividad->with('persona')->where('Id_Persona',$_SESSION['Usuario'][0])->get(),

  			'PersonaActividad' => $PersonaActividad->find($_SESSION['Usuario'][0]),

  			'Tipo' => $Tipo->find(46),

  			'tipoparque' => $TipoParque->with('parques')->find(3),

  			'localidad' => $Localidad->all()

  		];

      

    	return view('mi_actividad', $datos);

    }



    public function MiActividad2(){

   

      $consulta=ActividadGestor::with('localidad','persona','parque')->where('Id_Persona',$_SESSION['Usuario'][0])->get();

      return response()->json($consulta);

    }



    public function obtenerActividad(Request $request, $id_actividad){      

      $datosActividad = ActividadGestor::find($id_actividad);

      $datosActividadGestor = DB::select('select * from actividadgestor_actividad_eje_tematica

                                      inner join eje on eje.Id_Eje = actividadgestor_actividad_eje_tematica.eje_id

                                      inner join tematica on tematica.Id_Tematica = actividadgestor_actividad_eje_tematica.tematica_id

                                      inner join actividad on actividad.Id_Actividad = actividadgestor_actividad_eje_tematica.actividad_id

                                      where actividadgestor_actividad_eje_tematica.actividad_gestor_id = '.$id_actividad

                                    );

      $datosActividad['datosActividadGestor'] = $datosActividadGestor;      

      $datos = ['datosActividad' => $datosActividad];

    	return  $datos;

    }



    public function GetParques(Request $request, $id_localidad){

       $Parque = Parque::with('localidad')->where('Id_Localidad', '=', $id_localidad)->get();

       return $Parque;

    }

    

  }