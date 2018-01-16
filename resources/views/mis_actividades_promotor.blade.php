@extends('master')                              


@section('script')
	@parent

    <script src="{{ asset('public/Js/Actividad/actividad_gestores.js') }}"></script>	
@stop

@section('content') 
        
              
<div class="content" id="mis_actividad_gestores" class="row" data-url="gestores">
            <br>
              <h3 id="navbar">MIS ACTIVIDADES</h3>
            <br><br>
           


		<div class="panel panel-primary">
			  <div class="panel-heading">
			    <h3 class="panel-title">BUSCADOR: buscador de actvidades por fecha o id de la actividad.</h3>
			  </div>
			  <div class="panel-body">
					<fieldset>
						<form action="" id="form_actividad_gestor">
							<input type="hidden" name="_token" value="{{ csrf_token() }}"></input>
			        		<div class="col-xs-12 col-md-4">
			        			<div class="form-group">
			        			    <label class="control-label" for="Id_TipoDocumento">Id actividad</label>
			        				<input type="text" name="Id_Actividad_Promo" class="form-control">
			        				
			        			</div>
			        		</div>

			        		<div class="col-xs-12 col-md-4">
			        			<div class="form-group">
			        				<label class="control-label" for="Id_TipoDocumento">Fecha Inicio</label>
			        				<input type="text" data-role="datepicker" name="Fecha_Inicio" class="form-control">
			        			</div>
			        		</div>

			        		<div class="col-xs-12 col-md-4">
			        			<div class="form-group">
			        				<label class="control-label" for="Id_TipoDocumento">Fecha Fin</label>
			        				<input type="text" data-role="datepicker" name="Fecha_Fin" class="form-control">
			        			</div>
			        		</div>

			        		<div class="col-xs-12 col-md-12">
			        			<div class="form-group text-center">
			        				<button type="submit" class="btn btn-primary">Buscar</button>
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

		<div class="panel panel-primary">
		  <div class="panel-heading">
		    <h3 class="panel-title">ACTIVIDAD: Registro del estado de las actividades.</h3>
		  </div>
		  <div class="panel-body">		    				
	      		<table id="Tabla2" class="display" width="100%" cellspacing="0">
		        <thead>
		            <tr>
		                <th class="text-center">N°</th>
		                <th class="text-center">Id</th>
		                <th>Responsable</th>
		                <th>Fecha Ejecución</th>
		                <th>Localidad</th>
		                <th>Parque / Otro</th>
		                <th>Programación</th>
		                <th>Estado Programación</th>
		                <th>Ejecución</th>
		                <th>Estado Ejecución</th>
		            </tr>
		        </thead>
		        <tfoot>
		            <tr>
		                <th class="text-center">N°</th>
		                <th class="text-center">Id</th>
		                <th>Responsable</th>
		                <th>Fecha Ejecución</th>
		                <th>Localidad</th>
		                <th>Parque / Otro</th>
		                <th>Programación</th>
		                <th>Estado Programación</th>
		                <th>Ejecución</th>
		                <th>Estado Ejecución</th>
		            </tr>
		        </tfoot>
		        <tbody id="registros_actividades_responsable">		   
		        </tbody>
		    </table>
			  </div>
		</div>



  
 <!-- Modal formulario  actividad -->
<div class="modal fade bs-example-modal-lg" id="modal_form_act_eje" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
	<div class="modal-dialog modal-lg" role="document">
	   <div class="modal-content">
			<form action="" id="form_actividad_mm" name="form_actividad_mm">
				<div class="panel panel-primary">
				  <div class="panel-heading">
				    <h3 class="panel-title">Datos de asignación y configuración horaria</h3>
				  </div>
				  <div class="panel-body">
		      		<fieldset>
		        		<div class="col-xs-12 col-md-6">
		        			<div class="form-group">
		        				<label class="control-label" for="Id_TipoDocumento">* Fecha ejecución</label>
		        				<input type="text" name="Fecha_Ejecucion" class="form-control" readonly="readonly">
		        			</div>
		        		</div>

		        		<div class="col-xs-12 col-md-6">
		        			<div class="form-group">
		        				<label class="control-label" for="Id_TipoDocumento">* Responsable </label>
		        				<input type="text"  name="Id_Responsable" class="form-control" readonly="readonly">
		        			</div>
		        		</div>
		        		<div class="col-xs-12 col-md-6">
		        			<div class="form-group">
		        				<label class="control-label" for="Cedula">* Hora Inicio </label>
		        				
									<input type='text' name="Hora_Inicio" class="form-control" readonly="readonly" />
								
		        			</div>
		        		</div>
		        		<div class="col-xs-12 col-md-6">
		        			<div class="form-group">
		        				<label class="control-label" for="Cedula">* Hora Final </label>
								<input type='text' name="Hora_Fin" class="form-control" readonly="readonly" />
		        			</div>
		        		</div>
		        
		       		</fieldset>
				  </div>
				</div>
				<br>
				<div class="panel panel-primary">
				  <div class="panel-heading">
				    <h3 class="panel-title">PASO 3: Datos del escenario y la comunidad</h3>
				  </div>
				  <div class="panel-body">
		      		<fieldset>
		        		<div class="col-xs-12 col-md-6">
		        			<div class="form-group">
		        				<label class="control-label" for="Id_TipoDocumento">* Localidad</label>
		        				<input type="text" name="Id_Localidad" class="form-control" readonly="readonly">
		        			</div>
		        		</div>
		        		<div class="col-xs-12 col-md-6">
		        			<div class="form-group">
		        				<label class="control-label" for="Cedula">* Parque </label>
		        				<input type="text" name="Parque" class="form-control" readonly="readonly">
		        			</div>
		        		</div>

		        		<div class="col-xs-12 col-md-6">
		        			<div class="form-group">
		        				<label class="control-label" for="Id_TipoDocumento">* Caracteristica Lugar </label>
		        				<textarea class="form-control" rows="3" name="Caracteristica_Lugar" readonly="readonly"></textarea>
		        			</div>
		        		</div>
		        		

		        		<div class="col-xs-12 col-md-6">
		        			<div class="form-group">
		        				<label class="control-label" for="Id_TipoDocumento">* Caracteristica de la población </label>
		        				<textarea class="form-control" rows="3" name="Caracteristica_poblacion" readonly="readonly"></textarea>
		        			</div>
		        		</div>

		        		<div class="col-xs-12 col-md-6">
		        			<div class="form-group">
		        			    <label class="control-label" for="Id_TipoDocumento">* Institución, grupo, comunidad</label>
		        				<input type="text" name="Institucion_Grupo" class="form-control" readonly="readonly">
		        			</div>
		        		</div>

		        		<div class="col-xs-12 col-md-6">
		        			<div class="form-group">
		        			    <label class="control-label" for="Id_TipoDocumento">* Numero de asistentes</label>
		        				<input type="text" name="Numero_Asistentes" class="form-control" readonly="readonly">
		        			</div>
		        		</div>
		       		</fieldset>
				  </div>
				</div>
				<br>
				<div class="panel panel-primary">
				  <div class="panel-heading">
				    <h3 class="panel-title">PASO 4: Datos persona contacto</h3>
				  </div>
				  <div class="panel-body">				    				
		      		<fieldset>
		        		<div class="col-xs-12 col-md-6">
		        			<div class="form-group">
		        				<label class="control-label" for="Id_TipoDocumento">* Hora implementación</label>
									<input type='text' name="Hora_Implementacion" class="form-control" readonly="readonly"  />
		        			</div>
		        		</div>
		        		<div class="col-xs-12 col-md-6">
		        			<div class="form-group">
		        				<label class="control-label" for="Cedula">* Nombre persona contacto </label>
		        				<input type="text" name="Persona_Contacto" class="form-control" readonly="readonly">
		        			</div>
		        		</div>

		        		<div class="col-xs-12 col-md-6">
		        			<div class="form-group">
		        				<label class="control-label" for="Id_TipoDocumento">* Roll de la comunidad </label>
		        				<input type="text" name="Roll_Comunidad" class="form-control" readonly="readonly">
		        			</div>
		        		</div>
		        		<div class="col-xs-12 col-md-6">
		        			<div class="form-group">
		        				<label class="control-label" for="Id_TipoDocumento">* Telefono</label>
		        				<input type="text" name="Telefono" class="form-control" readonly="readonly">
		        			</div>
		        		</div>
		       		</fieldset>								    
				  </div>
				</div>
				<br>				
				<div class="form-group">
					<div id="alerta_actividad_error" class="col-xs-12" style="display:none;">
						<div class="alert alert-danger alert-dismissible" role="alert">
							<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							<div id="mensaje_alerta_final"></div>
						</div>
					</div>
				</div>
				<div class="form-group">
			      <div class="col-lg-12">
			         <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
			      </div>
			    </div>
			    <br><br> 					   
			</div>
			</form> 
	  </div>
  	</div>
</div> 

<!-- Modal formulario  Ejecucion -->
<div class="modal fade bs-example-modal-lg" id="modal_ejecucion" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
	<div class="modal-dialog modal-lg" role="document">
	   <div class="modal-content">
			<input type="hidden" name="Id_Actividad_ejecucion" class="form-control">			
			<div class="panel panel-primary">
			  <div class="panel-heading text-center">
			    <h3 class="panel-title">PASO 1: EJECUCIÓN DE ACTIVIDADES CAMPAÑA MASIVA</h3>
			  </div>
			  <div class="panel-body">										      	
	      		<form action="" id="form_ejecucion_datos_actividad" name="form_ejecucion_datos_actividad">
	      			<div class="col-xs-12 col-md-12">
	        			<div class="form-group">
	        				<h3>ACTIVIDAD N° <label class="control-label" for="Id_TipoDocumento" id="titulo"></label></h3>
	        			</div>
	        		</div>
	        		<div class="col-xs-12 col-md-6">
	        			<div class="form-group">
	        				<label class="control-label" for="Id_TipoDocumento">* Institucion, grupo, comunidad</label>
	        				<input type="text" name="Inst_grupo_comu" class="form-control">
	        			</div>
	        		</div>

	        		<div class="col-xs-12 col-md-6">
	        			<div class="form-group">
	        				<label class="control-label" for="Id_TipoDocumento">* Localidad </label>
	        				<select name="Localidad_eje" id="Localidad_eje" class="form-control">
	        					<option value="">Seleccionar</option>
	        					@foreach($Localidad as $localida)
	        						<option value="{{ $localida['Id_Localidad'] }}">{{ $localida['Nombre_Localidad'] }}</option>
	        					@endforeach
	        				</select>
	        			</div>
	        		</div>
	        		<div class="col-xs-12 col-md-6">
	        			<div class="form-group">
	        				<label class="control-label" for="Cedula">* Tipo entidad </label>
							<select name="Tipo_entidad" id="Tipo_entidad" class="form-control">
	        					<option value="">Seleccionar</option>
	        					@foreach($TipoEntidad as $tipoEntida)
	        						<option value="{{ $tipoEntida['Id'] }}">{{ $tipoEntida['Nombre'] }}</option>
	        					@endforeach
	        				</select>
	        			</div>
	        		</div>
	        		<div class="col-xs-12 col-md-6">
	        			<div class="form-group">
	        				<label class="control-label" for="Cedula">* Tipo </label>
							<select name="Tipo_eje" id="Tipo_eje" class="form-control">
	        					<option value="">Seleccionar</option>
	        					@foreach($TipoPersona as $tipoPerson)
	        						<option value="{{ $tipoPerson['Id'] }}">{{ $tipoPerson['Nombre'] }}</option>
	        					@endforeach
	        				</select>
	        			</div>
	        		</div>
	        		<div class="col-xs-12 col-md-6">
	        			<div class="form-group">
	        				<label class="control-label" for="Cedula">* Condición </label>
							<select name="Condicion" id="Condicion" class="form-control">
	        					<option value="">Seleccionar</option>
	        					@foreach($Condicion as $condicio)
	        						<option value="{{ $condicio['Id'] }}">{{ $condicio['Nombre'] }}</option>
	        					@endforeach
	        				</select>
	        			</div>
	        		</div>
	        		<div class="col-xs-12 col-md-6">
	        			<div class="form-group">
	        				<label class="control-label" for="Cedula">* Situación </label>
							<select name="Situacion" id="Situacion" class="form-control">
	        					<option value="">Seleccionar</option>
	        					@foreach($Situacion as $situacio)
	        						<option value="{{ $situacio['Id'] }}">{{ $situacio['Nombre'] }}</option>
	        					@endforeach
	        				</select>
	        			</div>
	        		</div>

	        		<div class="col-xs-12 col-md-2">
	        			<div class="form-group">
	        				<label class="control-label" for="Cedula">0 a 5</label>
							<input type='text' name="M_0_5" placeholder="Masculino" class="form-control"/>
							<input type='text' name="F_0_5" placeholder="Femenino"  class="form-control"/>
	        			</div>
	        		</div>
	        		<div class="col-xs-12 col-md-2">
	        			<div class="form-group">
	        				<label class="control-label" for="Cedula">6 a 12 </label>
							<input type='text' name="M_6_12" placeholder="Masculino" class="form-control"/>
							<input type='text' name="F_6_12" placeholder="Femenino"  class="form-control"/>
	        			</div>
	        		</div>
	        		<div class="col-xs-12 col-md-2">
	        			<div class="form-group">
	        				<label class="control-label" for="Cedula">13 a 17</label>
							<input type='text' name="M_13_17" placeholder="Masculino" class="form-control"/>
							<input type='text' name="F_13_17" placeholder="Femenino"  class="form-control"/>
	        			</div>
	        		</div>
	        		<div class="col-xs-12 col-md-2">
	        			<div class="form-group">
	        				<label class="control-label" for="Cedula">18 a 26 </label>
							<input type='text' name="M_18_26" placeholder="Masculino" class="form-control"/>
							<input type='text' name="F_18_26" placeholder="Femenino"  class="form-control"/>
	        			</div>
	        		</div>
	        		<div class="col-xs-12 col-md-2">
	        			<div class="form-group">
	        				<label class="control-label" for="Cedula">27 a 59</label>
							<input type='text' name="M_27_59" placeholder="Masculino" class="form-control"/>
							<input type='text' name="F_27_59" placeholder="Femenino"  class="form-control"/>
	        			</div>
	        		</div>
	        		<div class="col-xs-12 col-md-2">
	        			<div class="form-group">
	        				<label class="control-label text-center" for="Cedula">60 o mas </label>
							<input type='text' name="M_60" placeholder="Masculino" class="form-control"/>
							<input type='text' name="F_60" placeholder="Femenino"  class="form-control"/>
	        			</div>
	        		</div>
				      <div class="col-xs-12 col-md-12">
				         <button type="button" class="btn btn-primary" id="agregar_datos_ejecucion">Agregar</button>
				          <button type="button" class="btn btn-default" id="ver_datos_tabla_ejecucion">Ver</button>
				      </div>

				        <div class="col-xs-12 col-md-12">
							<br><br>
						</div>


						<div class="col-xs-12 col-md-12">
							<div class="alert alert-success alert-dismissible" role="alert" style="display:none;" id="ejecucion_agregada">
								
							</div>
						</div>

						<div class="col-xs-12 col-md-12">
							<div class="alert alert-info alert-dismissible" role="alert" style="display:none;" id="table_ejecucion_agregada">										
								<div class="table-responsive">
								  <table class="table table-bordered" id="datos_ejecucion_tabla">
								  <thead> 
						            <tr> 
						            <th rowspan="2">#</th> 
						            <th rowspan="2">INSTITUCIÓN/ GRUPO/ COMUNIDAD</th> 
						            <th rowspan="2">Localidad</th> 
						            <th rowspan="2">Entidad</th> 
						            <th rowspan="2">Tipo</th> 
						            <th rowspan="2">Condición</th> 
						            <th rowspan="2">Situación</th>
						            <th colspan="2">0 a 5</th> 
						            <th colspan="2">6 a 12</th>
						            <th colspan="2">13 a 17</th>
						            <th colspan="2">18 a 26</th>
						            <th colspan="2">27 a 59</th>
						            <th colspan="2">60 a más</th>
						            <th colspan="2">Total Genero</th>
						            <th colspan="1" rowspan="2">TOTAL</th>
						            <th colspan="2" rowspan="2">Eliminar</th>
						            </tr> 

						            </tr><tr>
									<td>F</td>
									<td>M</td>
									<td>F</td>
									<td>M</td>
									<td>F</td>
									<td>M</td>
									<td>F</td>
									<td>M</td>
									<td>F</td>
									<td>M</td>
									<td>F</td>
									<td>M</td>
									<td><center>Total F</center></td>
									<td><center>Total M</center></td>
									</tr>

						            </thead> 
						            <tbody id="registros_ejecucion_tabla"> 

						            </tbody> 
								  </table>
								</div>
								<div id="mensaje_eliminar"></div>
								<button type="button" class="btn btn-default" id="cerrar_tabla_ejecu">Cerrar</button>
							</div>
						</div>
	        	</form>										       		
			  </div>
			</div>
			<div class="panel panel-primary">
			  <div class="panel-heading text-center">
			    <h3 class="panel-title">PASO 2: REPORTE DE NOVEDADES</h3>
			  </div>
			  <div class="panel-body">
	      		<fieldset>
	      		  <form action="" id="form_ejecucion_novedades" name="form_ejecucion_novedades">
					<div class="col-xs-12 col-md-12">
	        			<div class="form-group">
	        				<label class="control-label" for="Id_TipoDocumento">Requisitos  que se incumplen</label>
	        				<select name="Id_Requisito" id="Id_Requisito" class="form-control">
	        					<option value="">Seleccionar</option>
	        					@foreach($ListaNovedad as $listaNoveda)
	        						<option value="{{ $listaNoveda['Id'] }}">{{ $listaNoveda['Nombre'] }}</option>
	        					@endforeach
	        				</select>
	        			</div>
	        		</div>										      		
	        		<div class="col-xs-12 col-md-6">
	        			<div class="form-group">
	        				<label class="control-label" for="Cedula">Causas o el porque</label>
							<input type='text' name="causa" class="form-control"/>
	        			</div>
	        		</div>
	        		<div class="col-xs-12 col-md-6">
	        			<div class="form-group">
	        				<label class="control-label" for="Cedula">Acciones Tomadas</label>
							<input type='text' name="accion" class="form-control"/>
	        			</div>
	        		</div>

				    <div class="col-xs-12 col-md-12">
				         <button type="button" class="btn btn-primary" data-dismiss="modal" id="agregar_datos_novedades">Agregar</button>
				          <button type="button" class="btn btn-default" data-dismiss="modal" id="ver_datos_tabla_novedades">Ver</button>
				    </div>
					<div class="col-xs-12 col-md-12"><br><br></div>

					<div class="col-xs-12 col-md-12">
						<div class="alert alert-success alert-dismissible" role="alert" style="display:none;" id="novedad_agregada">
							
						</div>
					</div>

					<div class="col-xs-12 col-md-12">
						<div class="alert alert-info alert-dismissible" role="alert" style="display:none;" id="table_novedad_agregada">									
							<div class="table-responsive">
							<table class="table table-bordered" id="datos_novedad_tabla"> 
							<thead>
							<tr>
							<th>#</th>
							<th>Requisitos que se incumplen</th>
							<th>Causas o el porque</th>
							<th>Acciones Tomadas</th>
							<th>Eliminar</th>
							</tr>
							</thead>
							<tbody id="registros_novedad"> 
							</tbody> 
							</table>
							</div>
							<div id="mensaje_eliminar"></div>
							<button type="button" class="btn btn-default" id="cerrar_tabla_novedad">Cerrar</button>
						</div>
					</div>

	        	  </form>
	       		</fieldset>
			  </div>
			</div>

			<div class="panel panel-primary">
			  <div class="panel-heading text-center">
			    <h3 class="panel-title">PASO 3: CALIFICACIÓN DEL SERVICIO</h3>
			  </div>
			  <div class="panel-body">
	      		<fieldset>
	      		<form action="" id="form_ejecucion_servicio" name="form_ejecucion_servicio">
	        		<div class="col-xs-12 col-md-4">
	        			<div class="form-group">
	        				<label class="control-label" for="Cedula">Manejo del tema</label><br>
							<select name="puntualidad" id="" class="form-control">
	        					<option value="">Selecionar</option>
	        					<option value="1">1</option>
	        					<option value="2">2</option>
	        					<option value="3">3</option>
	        					<option value="4">4</option>
	        					<option value="5">5</option>
	        				</select>
	        			</div>
	        		</div>
	        		<div class="col-xs-12 col-md-4">
	        			<div class="form-group">
	        				<label class="control-label" for="Cedula">Material utilizado</label>
							<select name="divulgacion" id="" class="form-control">
	        					<option value="">Selecionar</option>
	        					<option value="1">1</option>
	        					<option value="2">2</option>
	        					<option value="3">3</option>
	        					<option value="4">4</option>
	        					<option value="5">5</option>
	        				</select>
	        			</div>
	        		</div>
	        		<div class="col-xs-12 col-md-4">
	        			<div class="form-group">
	        				<label class="control-label" for="Cedula">Conocimiento adquirido</label>
							<select name="escenarioMontaje" id="" class="form-control">
	        					<option value="">Selecionar</option>
	        					<option value="1">1</option>
	        					<option value="2">2</option>
	        					<option value="3">3</option>
	        					<option value="4">4</option>
	        					<option value="5">5</option>
	        				</select>
	        			</div>
	        		</div>
	        		<div class="col-xs-12 col-md-2" style="display:none">
	        			<div class="form-group">
	        				<label class="control-label" for="Cedula">Cumplimiento</label>
							<select name="cumplimiento" id="" class="form-control">
	        					<option value="">Selecionar</option>
	        					<option value="1">1</option>
	        					<option value="2">2</option>
	        					<option value="3">3</option>
	        					<option value="4">4</option>
	        					<option value="5">5</option>
	        				</select>
	        			</div>
	        		</div>
	        		<div class="col-xs-12 col-md-2" style="display:none">
	        			<div class="form-group">
	        				<label class="control-label" for="Cedula">Variedad</label>
							<select name="variedadCreatividad" id="" class="form-control">
	        					<option value="">Selecionar</option>
	        					<option value="1">1</option>
	        					<option value="2">2</option>
	        					<option value="3">3</option>
	        					<option value="4">4</option>
	        					<option value="5">5</option>
	        				</select>
	        			</div>
	        		</div>
	        		<div class="col-xs-12 col-md-2" style="display:none">
	        			<div class="form-group">
	        				<label class="control-label text-center" for="Cedula">Seguridad</label>
							<select name="seguridad" id="" class="form-control">
								<option value="">Selecionar</option>
	        					<option value="1">1</option>
	        					<option value="2">2</option>
	        					<option value="3">3</option>
	        					<option value="4">4</option>
	        					<option value="5">5</option>
	        				</select>
	        			</div>
	        		</div>

	        		<div class="col-xs-12 col-md-6">
	        			<div class="form-group">
	        				<label class="control-label" for="Cedula">Nombre representante de la comunidad</label>
							<input type='text' name="nombreRepresentante" class="form-control"/>
	        			</div>
	        		</div>
	        		<div class="col-xs-12 col-md-6">
	        			<div class="form-group">
	        				<label class="control-label" for="Cedula">Telefono</label>
							<input type='text' name="telefonoRepresentante" class="form-control"/>
	        			</div>
	        		</div>

	        		<div class="col-xs-12 col-md-12">
	        			<div class="form-group">
	        				<blockquote>
							  <p>Archivos para la evidencia de la actividad</p>				
							</blockquote>
	        			</div>
	        		</div>


	        		<div class="col-xs-12 col-md-6">
	        			<div class="form-group">
						    <label for="exampleInputFile">Imagen 1</label>
						    <input type="file" name="imagen1">
						    <p class="help-block">Imagen en formato jpeg,jpg,png,bmp.</p>
						    <img id="imagenVer1" src="" alt="" class="img-thumbnail">
						 </div>
	        		</div>
	        		<div class="col-xs-12 col-md-6">
	        			<div class="form-group">
						    <label for="exampleInputFile">Imagen 2</label>
						    <input type="file" name="imagen2">
						    <p class="help-block">Imagen en formato jpeg,jpg,png,bmp.</p>
						    <img id="imagenVer2" src="" alt="" class="img-thumbnail">
						 </div>
	        		</div>
	        		<div class="col-xs-12 col-md-6">
	        			<div class="form-group">
						    <label for="exampleInputFile">Imagen 3</label>
						    <input type="file" name="imagen3">
						    <p class="help-block">Imagen en formato jpeg,jpg,png,bmp.</p>
						    <img id="imagenVer3" src="" alt="" class="img-thumbnail">
						 </div>
	        		</div>
	        		<div class="col-xs-12 col-md-6">
	        			<div class="form-group">
						    <label for="exampleInputFile">Imagen 4</label>
						    <input type="file" name="imagen4">
						    <p class="help-block">Imagen en formato jpeg,jpg,png,bmp.</p>
						    <img id="imagenVer4" src="" alt="" class="img-thumbnail">
						 </div>
	        		</div>
	        		<div class="col-xs-12 col-md-6">
	        			<div class="form-group">
						    <label for="exampleInputFile">Formato Evaluación</label>
						    <input type="file" name="listaAsistencia">
						    <p class="help-block">Archivo en formato pdf</p>
						    <a id="file1" href="" download style="display:none;">
							  <img border="0" src="public/Img/downloadicon.gif" alt="W3Schools" >
							</a>
						 </div>
	        		</div>
	        		<div class="col-xs-12 col-md-6">
	        			<div class="form-group">
						    <label for="exampleInputFile">Listado Entrega de Kits</label>
						    <input type="file" name="acta">
						    <p class="help-block">Archivo en formato pdf</p>
						    <a id="file2" href="" download style="display:none;">
							  <img border="0" src="public/Img/downloadicon.gif" alt="W3Schools" >
							</a>
						 </div>
	        		</div>
	        		<div class="col-xs-12 col-md-12">
	        			<div class="form-group">
	        				<br><br>
	        			</div>
	        		</div>
	        		<div class="col-xs-12 col-md-12">
							<div id="espera_eje"></div>
							<div class="alert alert-success alert-dismissible" role="alert" style="display:none;" id="registro_agregada_eje_b">
								
							</div>

							<div class="alert alert-danger alert-dismissible" role="alert" style="display:none;" id="registro_agregada_eje">
								
							</div>
					</div>				    				
	       		</fieldset>
			  </div>
			</div>   
			<div class="panel panel-primary">
			  <div class="panel-heading">
			    <h3 class="panel-title">PASO 5: Cancelación</h3>
			  </div>
			  <div class="panel-body">						    				
		      		<fieldset>
		        		<div class="col-xs-12 col-md-6">
		        			<div class="form-group">
		        				<label class="control-label" id="Observacion_CancelaL">* Observación de la cancelación</label>
		        				<textarea class="form-control" rows="3" name="Observacion_Cancela"></textarea>
		        			</div>
		        		</div>	
		        		<div class="col-xs-12 col-md-12" id="modalMensaj">
		        			<div Id="mensajeModifica"></div>
		        		</div>	
		        		<br><br><br><br><br><br><br><br>
		        		<div class="col-xs-12 col-md-12">
				    		<input type="hidden" name="Id_Actividad_E" class="form-control" value="">
				    		<input type="hidden" name="Id_Actividad_Gestion" class="form-control" value="">				    		
				    		<input type="hidden" name="Id_Calificacion_Servicio" class="form-control" value="">				    		
					         <center>						         						         
						         <button type="submit" class="btn btn-info" id="agregar_ejecucion">Registrar</button>
						         <button type="submit" class="btn btn-primary" id="modificar_ejecucion">Modificar</button>
						         <button type="submit" class="btn btn-danger" id="Cancelar_E">Cancelar</button>
						         <button type="button" class="btn btn-default" id="Cerrar_eje" data-dismiss="modal">Cerrar</button>
					         </center>
				    	</div>				        		
		       		</fieldset>										    
			  </div>
			  </form> 									        
			</div>
		</div>
	  </div>
  	</div>
</div> 
@stop