@extends('master')                              


@section('script')
	@parent

    <script src="{{ asset('public/Js/Actividad/reporte4.js') }}"></script>
    <script src="{{ asset('public/Js/bootstrap-datepicker.js') }}"></script>  

@stop

@section('content') 
    <div class="content" id="reporte" class="row" data-url="Reporte">
        <br>
          <h3 id="navbar">Reporte de las Ejecuciones</h3>
        <br><br>
		<div class="panel panel-primary">
			    <div class="panel-heading">
			    		<h3 class="panel-title">BUSCADOR: buscador para el reporte de datos de las ejecicuciones.</h3>
			    </div>
			    <div class="panel-body">
					<fieldset>
						<form action="" id="form_reporte4">
							<input type="hidden" name="_token" value="{{ csrf_token() }}"></input>
			        		<div class="form-group col-md-2">
                                <label for="inputEmail" class="control-label" id="Fecha_InicioL">Fecha Inicio:</label>
                            </div>
			        		<div class="form-group col-md-4">
                                <div class="input-group date form-control" id="FechaInicioDate" style="border: none;">
                                    <input id="Fecha_Inicio" class="form-control " type="text" value="" name="Fecha_Inicio" default="" data-date="" data-behavior="Fecha_Inicio">
                                <span class="input-group-addon btn"><i class="glyphicon glyphicon-calendar"></i> </span>
                                </div>    
                            </div>

                            <div class="form-group col-md-2">
                                <label for="inputEmail" class="control-label" id="Fecha_FinL">Fecha Fin:</label>
                            </div>
			        		<div class="form-group col-md-4">
                                <div class="input-group date form-control" id="FechaFinDate" style="border: none;">
                                    <input id="Fecha_Fin" class="form-control " type="text" value="" name="Fecha_Fin" default="" data-date="" data-behavior="Fecha_Fin">
                                <span class="input-group-addon btn"><i class="glyphicon glyphicon-calendar"></i> </span>
                                </div>    
                            </div> 

			        		<div class="col-xs-12 col-md-12">
			        			<div class="form-group text-center">
			        				<button type="button" id="Generar"  name="Generar" class="btn btn-primary">Generar</button>
			        			</div>
			        		</div>

			        		<div class="col-xs-12 col-md-12">
			        			<div class="form-group text-center">
			        				<div id="espera"></div>
			        			</div>
			        		</div>
				        </form>
					</fieldset>							      	
			  </div>			  
		</div>    
		<div class="content">
	        <div class="panel panel-primary">
	            <div class="panel-heading">
	              <h3 class="panel-title">REPORTE: Identifica el número total de actividades realizadas de acuerdo al filtro inicial.</h3>
	            </div>
	            <div class="container" id="loading" style="display:none;">
	            	<br><br>
			        <center><button class="btn btn-lg btn-default"><span class="glyphicon glyphicon-refresh glyphicon-refresh-animate"></span> Espere...</button></center>
			        <br><br>
			    </div>
	            <div class="panel-body" style="overflow: auto" Id="resultado">
	            	<table id="ejecucionesTabla" class="display nowrap" cellspacing="0" width="100%">
	                    <thead>
	                        <tr>
	                        	<th><center>ID</center></th>
	                            <th><center>FECHA REALIZACIÓN</center></th>
	                            <th><center>HORA INICIO</center></th>
	                            <th><center>LOCALIDAD</center></th>
	                            <th><center>PARQUE/ INSTITUCIÓN</center></th>
	                            <th><center>HORA IMPLEMENTACIÓN</center></th>
	                            <th><center>HORA FINAL</center></th>
	                            <th><center>EJE</center></th>
	                            <th><center>COMPONENTE</center></th>
	                            <th><center>ESTRATEGIA</center></th>
	                            <th><center>ENTREGA DE KITS (SI/NO)</center></th>
	                            <th><center>CANTIDAD DE KITS</center></th>
	                            <th><center>POBLACIÓN</center></th>
	                            <th><center>NÚMERO DE ASISTENTES</center></th>
	                            <th><center>ESTADO DE PROGRAMACIÓN</center></th>
	                            <th><center>ESTADO DE EJECUCIÓN</center></th>
	                        </tr>
	                    </thead>
	                    <tbody>
	                    </tbody> 
	                </table>
	            </div>
	        </div>
	    </div>
	</div>
@stop