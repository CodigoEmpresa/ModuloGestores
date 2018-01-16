<?php



namespace App\Http\Controllers;



use Illuminate\Http\Request;

use App\Http\Requests;

use Validator;

use App\Persona;

use App\ActividadGestor;

use App\Calificacion_servicio;

use App\TipoEntidad;

use App\TipoPersona;

use App\Condicion;

use App\Situacion;

use App\Localidad;

use App\ListaNovedad;

use App\Ejecucion;

use App\Novedad;

use App\ActividadGestorPersona;



class mis_actividades_promotores extends Controller

{

    //

   protected $Usuario;

   

   public function __construct(){

           if (isset($_SESSION['Usuario']))

           $Usuario = $_SESSION['Usuario'];

   }





    public function Mis_Actividad(){

    	$PersonaActividad = new Persona;

        $TipoEntidad = new TipoEntidad;

        $TipoPersona = new TipoPersona;

        $Condicion = new Condicion;

        $Situacion = new Situacion;

        $Localidad = new Localidad;

        $ListaNovedad = new ListaNovedad;



    	$datos = [

            'TipoEntidad' => $TipoEntidad->all(),

            'TipoPersona' => $TipoPersona->all(),

            'Condicion' => $Condicion->all(),

            'Situacion' => $Situacion->all(),

            'Localidad' => $Localidad->all(),

            'ListaNovedad' => $ListaNovedad->all()

		];

	    return view('mis_actividades_promotor', $datos);

    }





     public function procesarValidacionGestor(Request $request)

	{
        

		$validator = Validator::make($request->all(),

		    [

				'Fecha_Inicio' => 'required',

				'Fecha_Fin' => 'required'

        	]

        );



        if ($validator->fails()){

            return response()->json(array('status' => 'error', 'errors' => $validator->errors()));

        }else{

        	$inf_model= $this->buscar($request->all());

        }

        return response()->json($inf_model);

	}



	public function buscar($input)

	{

		$id=$_SESSION['Usuario'][0];

       

		$id_act=$input['Id_Actividad_Promo'];

		$Fecha_Inicio=$input['Fecha_Inicio'];

		$Fecha_Fin=$input['Fecha_Fin'];

        

    	if(empty($id_act)){            



            $actividadesInvitado = ActividadGestorPersona::where('actividad_gestor_id', $id)->lists('persona_id');

            $consulta=ActividadGestor::with('localidad','persona','parque')->whereIn('Id_Actividad_Gestor',$actividadesInvitado)->whereBetween('Fecha_Ejecucion',array($Fecha_Inicio, $Fecha_Fin))->get();



    	}else{



            $actividadesInvitado = ActividadGestorPersona::where('actividad_gestor_id', $id)->lists('persona_id');

            $consulta=ActividadGestor::with('localidad','persona','parque')->where('Id_Actividad_Gestor',$id_act)->whereIn('Id_Actividad_Gestor',$actividadesInvitado)->whereBetween('Fecha_Ejecucion',array($Fecha_Inicio, $Fecha_Fin))->get();



    	}

    	return $consulta;

	}



	public function obtenerActividad(Request $request, $id_actividad){



		$datosActividad = ActividadGestor::with('localidad','persona','parque','ejecucion')->find($id_actividad);

		$datos = ['datosActividad' => $datosActividad];

    	return  $datos;

    }



     public function obtenerEjecucion(Request $request, $id_actividad){

        $Ejecucion = Ejecucion::where('Id_Actividad_Gestor',$id_actividad)->with('tipoEntidad','tipoPersona','condicion','situacion','localidad')->get();        

        $Novedad = Novedad::where('Id_Actividad_Gestor',$id_actividad)->with('listaNovedad')->get();

        $datosActividad = ActividadGestor::with('calificaciomServicio')->find($id_actividad);

        

        $datos = ['datosActividad' => $datosActividad,'Ejecucion'=>$Ejecucion,'Novedad'=>$Novedad];

        return  response()->json($datos);

    }



    public function procesarValidacionDatosEjecucion(Request $request)

    {

        $validator = Validator::make($request->all(),

            [

                'Inst_grupo_comu' => 'required',

                'Localidad_eje' => 'required',

                'Tipo_entidad' => 'required',

                'Tipo_eje' => 'required',

                'Condicion' => 'required',

                'Situacion' => 'required',

                'M_0_5' => 'numeric',

                'F_0_5' => 'numeric',

                'M_6_12' => 'numeric',

                'F_6_12' => 'numeric',

                'M_13_17' => 'numeric',

                'F_13_17' => 'numeric',

                'M_18_26' => 'numeric',

                'F_18_26' => 'numeric',

                'M_27_59' => 'numeric',

                'F_27_59' => 'numeric',

                'M_60' => 'numeric',

                'F_60' => 'numeric'

            ]

        );



        if ($validator->fails()){

            return response()->json(array('status' => 'error', 'errors' => $validator->errors()));

        }else{

            return response()->json(array('status' => 'ok'));

        }

    }



    public function procesarValidacionDatosNovedades(Request $request)

    {

        $validator = Validator::make($request->all(),

            [

                'Id_Requisito' => 'required',

                'causa' => 'required:alpha',

                'accion' => 'required:alpha'

            ]

        );

        if ($validator->fails()){

            return response()->json(array('status' => 'error', 'errors' => $validator->errors()));

        }else{

            return response()->json(array('status' => 'ok'));

        }

    }



    public function procesarValidacionRegistroEjecucion(Request $request)
    {
        $validator = Validator::make($request->all(),
            [
                'puntualidad' => 'required',
                'divulgacion' => 'required',
                'escenarioMontaje' => 'required',
                'nombreRepresentante' => 'required',
                'telefonoRepresentante' => 'required',
                'imagen1' => 'required|mimes:jpeg,jpg,png,bmp',
                'imagen2' => 'required|mimes:jpeg,jpg,png,bmp',
                'imagen3' => 'mimes:jpeg,jpg,png,bmp',
                'imagen4' => 'mimes:jpeg,jpg,png,bmp',
                'listaAsistencia' => 'required|mimes:pdf'

            ]
        );


        if ($validator->fails()){
            return response()->json(array('status' => 'error', 'errors' => $validator->errors()));
        }else{
            
            $id_act = $request->input('Id_Actividad_E');
            
            $file1=$request->file('imagen1');
            $extension1=$file1->getClientOriginalExtension();
            $Nom_imagen1 = date('Y-m-d-H:i:s')."-imagen1-".$id_act.'.'.$extension1;
            $file1->move(public_path().'/Img/EvidenciaFotografica/', $Nom_imagen1);

            $file2=$request->file('imagen2');
            $extension2=$file2->getClientOriginalExtension();
            $Nom_imagen2 = date('Y-m-d-H:i:s')."-imagen2-".$id_act.'.'.$extension2;
            $file2->move(public_path().'/Img/EvidenciaFotografica/', $Nom_imagen2);


            if ($request->hasFile('imagen3')) {
                $file3=$request->file('imagen3');
                $extension3=$file3->getClientOriginalExtension();
                $Nom_imagen3 = date('Y-m-d-H:i:s')."-imagen3-".$id_act.'.'.$extension3;
                $file3->move(public_path().'/Img/EvidenciaFotografica/', $Nom_imagen3);

            }else{
                $Nom_imagen3="";
            }

            if ($request->hasFile('imagen4')) {
                $file4=$request->file('imagen4');
                $extension4=$file4->getClientOriginalExtension();
                $Nom_imagen4 = date('Y-m-d-H:i:s')."-imagen4-".$id_act.'.'.$extension4;
                $file4->move(public_path().'/Img/EvidenciaFotografica/', $Nom_imagen4);

            }else{
                $Nom_imagen4="";
            }
            $file_listaAsistencia=$request->file('listaAsistencia');
            $extensionFile1=$file_listaAsistencia->getClientOriginalExtension();
            $Nom_listaAsistencia = date('Y-m-d-H:i:s')."-listaAsistencia-".$id_act.'.'.$extensionFile1;
            $file_listaAsistencia->move(public_path().'/Img/EvidenciaArchivo/', $Nom_listaAsistencia);


            if ($request->hasFile('acta')) {
                $file_acta=$request->file('acta');
                $extensionFile2=$file_acta->getClientOriginalExtension();
                $Nom_Acta = date('Y-m-d-H:i:s')."-"."-acta-".$id_act.'.'.$extensionFile2;
                $file_acta->move(public_path().'/Img/EvidenciaArchivo/',$Nom_Acta);
            }else{
                $Nom_Acta="";
            }
            


            $nomarchivos= array(
                'imagen1'=> $Nom_imagen1,
                'imagen2'=> $Nom_imagen2,
                'imagen3'=> $Nom_imagen3,
                'imagen4'=> $Nom_imagen4,
                'listaAsistencia'=> $Nom_listaAsistencia ,
                'acta'=> $Nom_Acta);


            $this->guardar($request->all(),$nomarchivos);
        }


        return response()->json(array('status' => 'ok'));
    }





    public function guardar($input,$nomarchivos)

    {

        $model_A = new Calificacion_servicio;

        return $this->crear_ejecucion($model_A, $input,$nomarchivos);

    }



    public function crear_ejecucion($model, $input,$nomarchivos)

    {

        $model['Id_Actividad_Gestor'] = $input['Id_Actividad_E'];       





        $model['Id_Puntualidad'] = $input['puntualidad'];

        $model['Id_Divulgacion'] = $input['divulgacion'];

        $model['Id_Montaje'] = $input['escenarioMontaje'];

        $model['Id_Cumplimiento'] = $input['cumplimiento'];

        $model['Id_Variedad'] = $input['variedadCreatividad'];

        $model['Id_Seguridad'] = $input['seguridad'];

        $model['Nombre_Representante'] = $input['nombreRepresentante'];

        $model['Telefono'] = $input['telefonoRepresentante'];

        $model['Url_Imagen1'] = $nomarchivos['imagen1'];

        $model['Url_Imagen2'] = $nomarchivos['imagen2'];

        $model['Url_Imagen3'] = $nomarchivos['imagen3'];

        $model['Url_Imagen4'] = $nomarchivos['imagen4'];

        $model['Url_Asistencia'] = $nomarchivos['listaAsistencia'];

        $model['Url_Acta'] = $nomarchivos['acta'];

        $model->save();

                

        $id_Activi= $input['Id_Actividad_E'];

        $model_A = ActividadGestor::find($id_Activi);



        

        //  $model_P->calificaciomServicio()->attach($id_localidad);        

       $data0 = json_decode($input['vector_novedades']);
       foreach($data0 as $obj){

                 $model_A->novedad()->attach($model_A->Id_Actividad_Gestor,[
                'Id_novedad'=>$obj->Id_Requisito,

                'Causa'=>$obj->causa,

                'Accion'=>$obj->accion]);

        }





        $data01 = json_decode($input['vector_datos_ejecucion']);



    

        foreach($data01 as $obj1){

                 $model_A->ejecucion()->attach($model_A->Id_Actividad_Gestor,[

                'Comunidad'=>$obj1->Inst_grupo_comu,

                'Localidad'=>$obj1->Localidad_eje,

                'TipoEntidad'=>$obj1->Tipo_entidad,

                'Tipo'=>$obj1->Tipo_eje,

                'Condicion'=>$obj1->Condicion,

                'Situacion'=>$obj1->Situacion,

                'F_0a5'=>$obj1->F_0_5,

                'M_0a5'=>$obj1->M_0_5,

                'F_6a12'=>$obj1->F_6_12,

                'M_6a12'=>$obj1->M_6_12,

                'F_13a17'=>$obj1->F_13_17,

                'M_13a17'=>$obj1->M_13_17,

                'F_18a26'=>$obj1->F_18_26,

                'M_18a26'=>$obj1->M_18_26,

                'F_27a59'=>$obj1->F_27_59,

                'M_27a59'=>$obj1->M_27_59,

                'F_60'=>$obj1->M_60,

                'M_60'=>$obj1->F_60

                ]);

        }



        $hoy = date("Y-m-d");  

        $model_A['Estado_Ejecucion'] = 2;

        $model_A['Fecha_Registro_Ejecucion'] = $hoy;

        $model_A->save();





        return $model;

    }



    function cancelarEjecucion (Request $request, $id_actividad, $Observacion_Cancela){

        ActividadGestor::where('Id_Actividad_Gestor', $id_actividad)->update(array('Estado_Ejecucion' => 4, "Observacion_Cancela_Ejecucion" => $Observacion_Cancela)); 

        return  "Cancelación de la ejecucion realizada con éxito";

    }





    /************************************************/

    public function procesarValidacionModificacionEjecucion(Request $request)

    {



        $model_A = Calificacion_servicio::find($request->Id_Calificacion_Servicio);

        $archivos[0]= explode('.', $model_A['Url_Imagen1']);

        $archivos[1]= explode('.', $model_A['Url_Imagen2']);

        $archivos[2]= explode('.', $model_A['Url_Imagen3']);

        $archivos[3]= explode('.', $model_A['Url_Imagen4']);

        $archivos[4]= explode('.', $model_A['Url_Asistencia']);

        $archivos[5]= explode('.', $model_A['Url_Acta']);



        $validator = Validator::make($request->all(),

            [

                'puntualidad' => 'required',

                'divulgacion' => 'required',

                'escenarioMontaje' => 'required',

                'nombreRepresentante' => 'required',

                'telefonoRepresentante' => 'required',

                'imagen1' => 'mimes:jpeg,jpg,png,bmp',

                'imagen2' => 'mimes:jpeg,jpg,png,bmp',

                'imagen3' => 'mimes:jpeg,jpg,png,bmp',

                'imagen4' => 'mimes:jpeg,jpg,png,bmp',

                'listaAsistencia' => 'mimes:pdf'



            ]

        );





        if ($validator->fails()){

            return response()->json(array('status' => 'error', 'errors' => $validator->errors()));

        }else{

            

            $id_act = $request->input('Id_Actividad_E');

            

            if ($request->hasFile('imagen1')) {

                $file1=$request->file('imagen1');

                $extension1=$file1->getClientOriginalExtension();

                $Nom_imagen1 = $archivos[0][0].'.'.$extension1;

                $file1->move(public_path().'/Img/EvidenciaFotografica/', $Nom_imagen1);

            }else{

                $Nom_imagen1=$model_A['Url_Imagen1'];

            }



            if ($request->hasFile('imagen2')) {

                $file2=$request->file('imagen2');

                $extension2=$file2->getClientOriginalExtension();

                $Nom_imagen2 = $archivos[1][0].'.'.$extension2;

                $file2->move(public_path().'/Img/EvidenciaFotografica/', $Nom_imagen2);

            }else{

                $Nom_imagen2=$model_A['Url_Imagen2'];

            }





            if ($request->hasFile('imagen3')) {

                $file3=$request->file('imagen3');

                $extension3=$file3->getClientOriginalExtension();

                $Nom_imagen3 = $archivos[2][0].'.'.$extension3;

                $file3->move(public_path().'/Img/EvidenciaFotografica/', $Nom_imagen3);



            }else{

                $Nom_imagen3=$model_A['Url_Imagen3'];

            }



            if ($request->hasFile('imagen4')) {

                $file4=$request->file('imagen4');

                $extension4=$file4->getClientOriginalExtension();

                $Nom_imagen4 = $archivos[3][0].'.'.$extension4;

                $file4->move(public_path().'/Img/EvidenciaFotografica/', $Nom_imagen4);



            }else{

                $Nom_imagen4=$model_A['Url_Imagen4'];

            }



            if ($request->hasFile('listaAsistencia')) {

                $file_listaAsistencia=$request->file('listaAsistencia');

                $extensionFile1=$file_listaAsistencia->getClientOriginalExtension();

                $Nom_listaAsistencia = $archivos[4][0].'.'.$extensionFile1;

                $file_listaAsistencia->move(public_path().'/Img/EvidenciaArchivo/', $Nom_listaAsistencia);

            }else{

                $Nom_listaAsistencia = $model_A['Url_Asistencia'];

            }





            if ($request->hasFile('acta')) {

                $file_acta=$request->file('acta');

                $extensionFile2=$file_acta->getClientOriginalExtension();

                $Nom_Acta = $archivos[5][0].'.'.$extensionFile2;

                $file_acta->move(public_path().'/Img/EvidenciaArchivo/',$Nom_Acta);

            }else{

                $Nom_Acta=$model_A['Url_Acta'];

            }

            





            $nomarchivos= array(

                'imagen1'=> $Nom_imagen1,

                'imagen2'=> $Nom_imagen2,

                'imagen3'=> $Nom_imagen3,

                'imagen4'=> $Nom_imagen4,

                'listaAsistencia'=> $Nom_listaAsistencia ,

                'acta'=> $Nom_Acta);





            $this->modificar($request->all(),$nomarchivos);

        }





        return response()->json(array('status' => 'ok'));

    }





    public function modificar($input,$nomarchivos)

    {    

        $model_A = Calificacion_servicio::find($input['Id_Calificacion_Servicio']);

        return $this->modificar_ejecucion($model_A, $input,$nomarchivos);

    }



    public function modificar_ejecucion($model, $input,$nomarchivos)

    {

        $model['Id_Actividad_Gestor'] = $input['Id_Actividad_E'];       





        $model['Id_Puntualidad'] = $input['puntualidad'];

        $model['Id_Divulgacion'] = $input['divulgacion'];

        $model['Id_Montaje'] = $input['escenarioMontaje'];

        $model['Id_Cumplimiento'] = $input['cumplimiento'];

        $model['Id_Variedad'] = $input['variedadCreatividad'];

        $model['Id_Seguridad'] = $input['seguridad'];

        $model['Nombre_Representante'] = $input['nombreRepresentante'];

        $model['Telefono'] = $input['telefonoRepresentante'];

        $model['Url_Imagen1'] = $nomarchivos['imagen1'];

        $model['Url_Imagen2'] = $nomarchivos['imagen2'];

        $model['Url_Imagen3'] = $nomarchivos['imagen3'];

        $model['Url_Imagen4'] = $nomarchivos['imagen4'];

        $model['Url_Asistencia'] = $nomarchivos['listaAsistencia'];

        $model['Url_Acta'] = $nomarchivos['acta'];

        $model->save();

                

        $id_Activi= $input['Id_Actividad_E'];

        $model_A = ActividadGestor::find($id_Activi);



       $data0 = json_decode($input['vector_novedades']);



       $model_A->novedad()->where('Id_Actividad_Gestor', $input['Id_Actividad_Gestion'])->detach();

       foreach($data0 as $obj){



                 $model_A->novedad()->attach($model_A->Id_Actividad_Gestor,['Id_novedad'=>$obj->Id_Requisito,

                'Causa'=>$obj->causa,

                'Accion'=>$obj->accion]);

        }





        $data01 = json_decode($input['vector_datos_ejecucion']);

        $model_A->ejecucion()->where('Id_Actividad_Gestor', $input['Id_Actividad_Gestion'])->detach();

    

        foreach($data01 as $obj1){

                 $model_A->ejecucion()->attach($model_A->Id_Actividad_Gestor,[

                'Comunidad'=>$obj1->Inst_grupo_comu,

                'Localidad'=>$obj1->Localidad_eje,

                'TipoEntidad'=>$obj1->Tipo_entidad,

                'Tipo'=>$obj1->Tipo_eje,

                'Condicion'=>$obj1->Condicion,

                'Situacion'=>$obj1->Situacion,

                'F_0a5'=>$obj1->F_0_5,

                'M_0a5'=>$obj1->M_0_5,

                'F_6a12'=>$obj1->F_6_12,

                'M_6a12'=>$obj1->M_6_12,

                'F_13a17'=>$obj1->F_13_17,

                'M_13a17'=>$obj1->M_13_17,

                'F_18a26'=>$obj1->F_18_26,

                'M_18a26'=>$obj1->M_18_26,

                'F_27a59'=>$obj1->F_27_59,

                'M_27a59'=>$obj1->M_27_59,

                'F_60'=>$obj1->M_60,

                'M_60'=>$obj1->F_60

                ]);

        }



        $hoy = date("Y-m-d");  

        $model_A['Estado_Ejecucion'] = 2;

        $model_A['Fecha_Registro_Ejecucion'] = $hoy;

        $model_A->save();





        return $model;

    }

    /************************************************/



}

