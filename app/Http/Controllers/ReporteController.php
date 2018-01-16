<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests;
use Validator;
use Exception;

use App\TipoEntidad;
use App\TipoPersona;
use App\Condicion;
use App\Situacion;
use App\Localidad;
use App\Ejecucion;
use App\ActividadGestor;
use App\Eje;
use App\Tematica;
use App\Actividad;
use App\Persona;


class ReporteController extends Controller
{
    
    public function reporte()
    {
        $TipoEntidad = new TipoEntidad;
        $TipoPersona = new TipoPersona;
        $Condicion = new Condicion;
        $Situacion = new Situacion;
        $Localidad = new Localidad;

    	$datos = [
            'TipoEntidad' => $TipoEntidad->all(),
            'TipoPersona' => $TipoPersona->all(),
            'Condicion' => $Condicion->all(),
            'Situacion' => $Situacion->all(),
            'Localidad' => $Localidad->all()
		];
	    return view('reporte', $datos);
    }


    

    public function reportePoblacional(Request $request)
    {
    	$datos =$request->all();

		
		$Ejecucion = Ejecucion::with('tipoEntidad','tipoPersona','condicion','situacion','localidad');

		if($datos['Localidad']!="")
		$Ejecucion=$Ejecucion->where('Localidad',$datos['Localidad']);

		if($datos['Tipo_entidad']!="")
		$Ejecucion=$Ejecucion->where('TipoEntidad',$datos['Tipo_entidad']);

		if($datos['Tipo_eje']!="")
	    $Ejecucion=$Ejecucion->where('Tipo',$datos['Tipo_eje']);

		if($datos['Condicion']!="")
	    $Ejecucion=$Ejecucion->where('Condicion',$datos['Condicion']);
	    
	    if($datos['Situacion']!="")
	    $Ejecucion=$Ejecucion->where('Situacion',$datos['Situacion']);

	    $Ejecucion=$Ejecucion->get();



	    $tabla="<table id='Tabla_Reporte'>
			        <thead>
			            <tr>
							<th>Género / Edad</b></th>
							<th>5 a 6</th>
							<th>6 a 12</th> 
							<th>13 a 17</th>
							<th>18 a 26</th>
							<th>27 a 59</th>
							<th>60</th>
							<th>TOTAL GÉNERO</th>
						</tr>
					</thead>
						<tbody>
						<tr>";
												$F5a6 =0;
												$F6a12=0;
												$F13a17=0;
												$F18a26=0;
												$F27a59=0;
												$F60=0;
											    foreach ($Ejecucion as $item) {
												    $consulta=ActividadGestor::where('Id_Actividad_Gestor',$item['Id_Actividad_Gestor'])->where('Estado_Ejecucion',3)->where('Estado',2)->whereBetween('Fecha_Ejecucion',array($datos['Fecha_Inicio'], $datos['Fecha_Fin']))->get();
												    
												    if(count($consulta)>0){
													    $F5a6 = $F5a6 + $item['F_0a5'];
														$F6a12 = $F6a12 + $item['F_6a12'];
														$F13a17 = $F13a17 + $item['F_13a17'];
														$F18a26 = $F18a26 + $item['F_18a26'];
														$F27a59 = $F27a59 + $item['F_27a59'];
														$F60 = $F60 + $item['F_60'];
													}
												}
												$TOTALFEMENINO = $F5a6 + $F6a12 +$F13a17 +$F18a26+ $F27a59+ $F60;

												$TOTALFEMENINO = $F5a6 + $F6a12 +$F13a17 +$F18a26+ $F27a59+ $F60;
												$tabla=$tabla."<td>Femenino</td>
												<td>".$F5a6." </td>
												<td>".$F6a12." </td>
												<td>".$F13a17." </td>
												<td>".$F18a26." </td>
												<td>".$F27a59." </td>
												<td>".$F60." </td>
												<td><b>".$TOTALFEMENINO." </td>
										        </tr>";
										
										$tabla=$tabla."<tr>";
											
											
												$M5a6 =0;
												$M6a12=0;
												$M13a17=0;
												$M18a26=0;
												$M27a59=0;
												$M60=0;
											    foreach ($Ejecucion as $item) {
												    $consulta=ActividadGestor::where('Id_Actividad_Gestor',$item['Id_Actividad_Gestor'])->where('Estado_Ejecucion',3)->where('Estado',2)->whereBetween('Fecha_Ejecucion',array($datos['Fecha_Inicio'], $datos['Fecha_Fin']))->get();
												    if(count($consulta)>0){
													    $M5a6 = $M5a6 + $item['M_0a5'];
														$M6a12 = $M6a12 + $item['M_6a12'];
														$M13a17 = $M13a17 + $item['M_13a17'];
														$M18a26 = $M18a26 + $item['M_18a26'];
														$M27a59 = $M27a59 + $item['M_27a59'];
														$M60 = $M60 + $item['M_60'];
													}
												}

												$TOTALMASCULINO = $M5a6 + $M6a12 +$M13a17 +$M18a26+ $M27a59+ $M60;
												$tabla=$tabla."<td><font color='#0B0B61'>Masculino</td>
												<td>".$M5a6." </td>
												<td>".$M6a12." </td>
												<td>".$M13a17." </td>
												<td>".$M18a26." </td>
												<td>".$M27a59." </td>
												<td>".$M60." </td>
												<td><b>".$TOTALMASCULINO." </td>
										</tr>";
										
										$TOTAL1=$F5a6 +$M5a6;
										$TOTAL2=$F6a12 +$M6a12;
										$TOTAL3=$F13a17 +$M13a17;
										$TOTAL4=$F18a26 +$M18a26;
										$TOTAL5=$F27a59 +$M27a59;
										$TOTAL6=$F60 +$M60;
										$TOTAL = $TOTALMASCULINO + $TOTALFEMENINO ;
										
								$tabla=$tabla."<tr>
								<td><font color='#0B0B61'><b>TOTAL EDAD</td>
								<td><b>".$TOTAL1."</td>
								<td><b>".$TOTAL2."</td> 
								<td><b>".$TOTAL3."</td>
								<td><b>".$TOTAL4."</td>
								<td><b>".$TOTAL5."</td>
								<td><b>".$TOTAL6."</td>
								<td>  <font color='#018406'><b> TOTAL ".$TOTAL."</td>
								</tr>
								</tbody>
								</table>";

        return  $tabla;
    }


    public function reporte2()
    {
		$Eje = new Eje;
        $Tematica = new Tematica;
        $Actividad = new Actividad;
        $Localidad = new Localidad;

		$datos = [
	        'eje' => $Eje->all(),
	        'tematica' => $Tematica->all(),
	        'actividad' => $Actividad->all(),
	        'Localidad' => $Localidad->all(),
		];
		return view('reporte2', $datos);
    }



    public function reporteDatosActividades(Request $request)
    {
    	
	    
	    	$datos =$request->all();

	    	if($datos['Fecha_Inicio']!="" && $datos['Fecha_Fin']!=""){

	    		$cont=0;
		    	$consulta=ActividadGestor::where('Estado_Ejecucion',3)->where('Estado',2)->whereBetween('Fecha_Ejecucion',array($datos['Fecha_Inicio'], $datos['Fecha_Fin']));

		    		if($datos['Localidad']!="")
					{
						$consulta=$consulta->where('Localidad',$datos['Localidad'])->with('localidad');
						$cont++;
					}
					$consulta=$consulta->get();
													    
				$Total=0;
				$eje_nom="";
				$tematica_nom="";
				$actividad_nom="";
				$nom_localidad="";
						
			    foreach ($consulta as $item) {

			    	$Ejecucion = DB::table('actividadgestor_actividad_eje_tematica');

					if($datos['Id_Eje']!="")
					{
						$Ejecucion=$Ejecucion->where('eje_id',$datos['Id_Eje']);
						$eje = DB::table('eje')->select('Nombre_Eje')->where('Id_Eje',$datos['Id_Eje'])->first();
						$eje_nom=$eje->Nombre_Eje;
					}

					if($datos['Id_Tematica']!="")
					{
						$Ejecucion=$Ejecucion->where('tematica_id',$datos['Id_Tematica']);
						$tematica = DB::table('tematica')->select('Nombre_Tematica')->where('Id_Tematica',$datos['Id_Tematica'])->first();
						$tematica_nom=$tematica->Nombre_Tematica;
					}

					if($datos['d_Actividad']!="")
					{
						$Ejecucion=$Ejecucion->where('actividad_id',$datos['d_Actividad']);
						$acividad = DB::table('actividad')->select('Nombre_Actividad')->where('Id_Actividad',$datos['d_Actividad'])->first();
						$actividad_nom=$acividad->Nombre_Actividad;
					}
					$Ejecucion=$Ejecucion->get();

					if($cont!=0){
						$nom_localidad=$item->localidad['Nombre_Localidad'];
					}
					else{
						$nom_localidad="Todo";
					}
				    			    
				    if(count($Ejecucion)>0){
					    $Total ++;
					}
				}



		            $tabla="<table id='Tabla_Reporte2'>
					        <thead>
					            <tr>
									<th>Localidad</b></th>
									<th>Eje</th>
									<th>Componente</th> 
									<th>Estrategia</th>
									<th># Actividades Realizadas</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td>".$nom_localidad."</td>
									<td>".$eje_nom."</td>
									<td>".$tematica_nom."</td>
									<td>".$actividad_nom."</td>
									<td><center><b>".$Total."</b></center></td>
								</tr>
							</tbody>
						</table>";
												

	        
	    }else{
	    	$tabla="<div class='alert alert-danger'>
			  <strong>ALERTA!</strong> Ingrese fecha inicio y fin.
			</div>";
	    }
	    return  $tabla;
    }


     public function reporte3()
    {		
		return view('reporte3');
    }

    public function DatosActividadReporte3(Request $request){
    	if ($request->ajax()) { 
    		$validator = Validator::make($request->all(), [
    			'Fecha_Inicio' => 'required',
    			'Fecha_Fin' => 'required',
    			]);

	        if ($validator->fails()){
	            return response()->json(array('status' => 'error', 'errors' => $validator->errors()));
	        }else{
	        	$consulta=ActividadGestor::with('localidad','persona','parque','personaProgramador', 'GestorActividadEjetematica', 'GestorActividadEjetematica.eje', 'GestorActividadEjetematica.tematica', 'GestorActividadEjetematica.actividad')->whereBetween('Fecha_Ejecucion',array($request['Fecha_Inicio'], $request['Fecha_Fin']))->get();
	        	return $consulta;
			}
		}else{
			return response()->json(["Sin acceso"]);
		}    	
    }

    public function reporte4()
    {		
		return view('reporte4');
    }

}


