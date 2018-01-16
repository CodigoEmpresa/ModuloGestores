@extends('master')                              

@section('script')
	@parent

    <script src="{{ asset('public/Js/Actividad/mi_actividad.js') }}"></script>	
@stop

@section('content') 
        
              
<div class="content" id="main_mis_actividad" class="row" data-url="actividad">
            <br>
              <blockquote>
              <h3 id="navbar">MIS PROGRAMACIONES</h3>
              </blockquote>
              <div id="espera_3"></div>
            <br><br>
           
<form action="" id="form_actividad">

			<div class="panel panel-primary">
			  <div class="panel-heading">
			    <h3 class="panel-title">MIS PROGRAMACIONES: Registro histórico de mis programaciones.</h3>
			  </div>
			  <div class="panel-body">
			    				
							      		<table id="example" class="display" width="100%" cellspacing="0">
										        <thead>
										            <tr>
										                <th>N°</th>
										                <th>Id</th>
										                <th>Responsable</th>
										                <th>Fecha Ejecución</th>
										                <th>Localidad</th>
										                <th>Hora</th>
										                <th>Parque / Otro</th>
										                <th>Ver</th>
										            </tr>
										        </thead>
										        <tfoot>
										            <tr>
										                <th>N°</th>
										                <th>Id</th>
										                <th>Responsable</th>
										                <th>Fecha Ejecución</th>
										                <th>Localidad</th>
										                <th>Hora</th>
										                <th>Parque / Otro</th>
										                <th>Ver</th>
										            </tr>
										        </tfoot>
										        <tbody>
								           <?php $var =1; $clase =""; ?>
											
								           @foreach($datosActividad as $actividad)

								           <?php 
								           				$fecha_actual = date('Y-m-d'); 
								                       if($actividad['Estado']==2 || $actividad['Fecha_Ejecucion']<$fecha_actual){  //No hay informacion
                                                            $clase="btn btn-default";
                                                        }else{
                                                            $clase="btn btn-success";
                                                        }
								           ?>
								               <tr>
								        		    <td>{{ $var }}</td>
								        		    <td class="text-center"><h4>{{ $actividad['Id_Actividad_Gestor'] }}</h4></td>
								        		    <td>{{ $actividad->persona['Primer_Apellido'].' '.$actividad->persona['Segundo_Apellido'].' '.$actividad->persona['Primer_Nombre'].' '.$actividad->persona['Segundo_Nombre'] }}</td>
									                <td>{{ $actividad['Fecha_Ejecucion'] }}</td>
									                <td>{{ $actividad->localidad['Nombre_Localidad'] }}</td>
									                <td>{{ $actividad['Hora_Incial'].' - '.$actividad['Hora_Final'] }}</td>
									                <td>{{ $actividad->parque['Nombre'].''.$actividad['Otro'] }}</td>
									                <td class="text-center">
									                <button type="button" data-rel="{{ $actividad['Id_Actividad_Gestor'] }}" data-funcion="ver" class="{{ $clase }} eliminar_dato_actividad">Ver</button><div id="espera_3_{{ $actividad['Id_Actividad_Gestor'] }}"></div>
									                </td>
								                </tr>
								                 <?php $var++; ?>
							        		@endforeach
								   
								        </tbody>
								    </table>
			  </div>

</form>       
 		   
</div>           




  
 <!-- Modal formulario  actividad -->
<div class="modal fade bs-example-modal-lg" id="modal_form_actividades" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
	<div class="modal-dialog modal-lg" role="document">
	   <div class="modal-content">

			<form action="" id="form_actividad_m" name="form_actividad_m">
						
						<h3>ACTIVIDAD N° <label class="control-label" for="Id_TipoDocumento" id="titulo_id"></label></h3><br>						
						<div class="panel panel-primary">
						  <div class="panel-heading">
						    <h3 class="panel-title">Datos básicos</h3>
						  </div>
						  <div class="panel-body">
					      			<table id="ver_registros" class="table table-bordered">
					      			
								        <thead>
								            <tr>
								                <th>Eje</th>
								                <th>Componente</th>
								                <th>Estrategia</th>
								                <th>Kit</th>
								                <th>Cantidad de kits</th>
								                <th>Modificar</th>
								            </tr>
								        </thead>
								        <tbody id="actividadGestor" name="actividadGestor">
								        </tbody>
								    </table>
								    <input type="hidden" id="id_T" name="id_T" value=""/>
								      <div id="datos_modificar" style="display: none;">
					        				<div class="col-xs-12 col-md-12">
										        			<div class="form-group">
										        				<label class="control-label" for="Id_Eje">* Eje</label>
										        				<select name="Id_Eje" id="" class="form-control">
										        					<option value="">Seleccionar</option>
										        					@foreach($eje as $eje)
										        						<option value="{{ $eje['Id_Eje'] }}">{{ $eje['Nombre_Eje'] }}</option>
										        					@endforeach
										        				</select>
										        			</div>
										    </div>

										    <div class="col-xs-12 col-md-12">
										        			<div class="form-group">
										        				<label class="control-label" for="Id_Tematica">* Componente </label>
										        				<select name="Id_Tematica" id="" class="form-control">
										        					<option value="">Seleccionar</option>¿
										        				</select>
										        			</div>
										     </div>

										     <div class="col-xs-12 col-md-12">
										        			<div class="form-group">
										        				<label class="control-label" for="d_Actividad">* Estrategia </label>
										        				<select name="d_Actividad" id="" class="form-control">
										        					<option value="">Seleccionar</option>
										        				</select>
										        			</div>
										      </div>
										      <div class="col-xs-12 col-md-12" style="display: none;" id="div_otro">
										        			<div class="form-group" >
										        				<label class="control-label" for="d_Actividad">* Otro</label>
										        				<input type="text" name="otro_Actividad" value="" class="form-control">
										        			</div>
									           </div>
									           <div class="col-xs-12 col-md-12">
				                                    <div class="form-group col-md-6">	
				                                        <div id="radio_kit" class="btn-group" data-toggle="buttons">
				                                            <label class="btn btn-default">
				                                                <input type="radio" name="Kit" value="1" autocomplete="off"> <span class="text-success">SI</span>
				                                            </label>
				                                            <label class="btn btn-default">
				                                                <input type="radio" name="Kit" value="2" autocomplete="off"> <span class="text-danger">NO</span>
				                                            </label>
				                                        </div>
				                                    </div>
				                                    <div class="col-md-6">				
								        				<label class="control-label" for="d_Actividad">Cantidad </label>
								        				<input type="text" name="Cantidad_Kit" id="Cantidad_Kit" class="form-control">
								        			</div>				        		
							        		</div>
							  
									        <button type="button" id="cerrar_datos_modificar" class="btn btn-default">Cerrar</button>
									        <button type="button" class="btn btn-primary" id="modificar_eje">Agregar</button>
								
							     	  </div>
							     	  <br>
										<div class="col-xs-12 col-md-12"  >
					        				<div class="form-group"  id="mensaje_actividad" style="display: none;">
						        			<div id="alert_actividad"></div>
					        			</div>

						  </div>
						</div>
						<div class="panel panel-primary">
						  <div class="panel-heading">
						    <h3 class="panel-title">Datos de asignación y configuración horaria</h3>
						  </div>
						  <div class="panel-body">
										      		<fieldset>
										        		<div class="col-xs-12 col-md-6">
										        			<div class="form-group">
										        				<label class="control-label" for="Id_TipoDocumento">* Fecha ejecución</label>
										        				<input type="text" data-role="datepicker" name="Fecha_Ejecucion" class="form-control" >
										        			</div>
										        		</div>

										        		<div class="col-xs-12 col-md-6">
										        			<div class="form-group">
										        				<label class="control-label" for="Id_TipoDocumento">* Responsable </label>
										        				<select name="Id_Responsable" id="" class="form-control">
										        					<option value="">Seleccionar</option>
										        					@foreach($Tipo->personas as $Tipo)
										        						<option value="{{ $Tipo['Id_Persona'] }}">{{ $Tipo['Primer_Apellido'].' '.$Tipo['Segundo_Apellido'].' '.$Tipo['Primer_Nombre'].' '.$Tipo['Segundo_Nombre'] }}</option>
										        					@endforeach
										        				</select>
										        			</div>
										        		</div>
										        		<div class="col-xs-12 col-md-6">
										        			<div class="form-group">
										        				<label class="control-label" for="Cedula">* Hora Inicio </label>
										        				<div class='input-group date' id='datetimepicker1_m'>
																	<input type='text' name="Hora_Inicio" class="form-control" value=""  />
																	<span class="input-group-addon"><span class="glyphicon glyphicon-time"></span>
																	</span>
																</div>
										        			</div>
										        		</div>
										        		<div class="col-xs-12 col-md-6">
										        			<div class="form-group">
										        				<label class="control-label" for="Cedula">* Hora Final </label>
										        				<div class='input-group date' id='datetimepicker2_m'>
																	<input type='text' name="Hora_Fin" class="form-control" value=""  />
																	<span class="input-group-addon"><span class="glyphicon glyphicon-time"></span>
																	</span>
																</div>
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
										        				<input type="hidden" name="IdLocalidad" id="IdLocalidad" value="">
										        				<select name="Id_Localidad" id="Id_Localidad" class="form-control">
										        					<option value="">Seleccionar</option>
										        					@foreach($localidad as $localidad)
										        						<option value="{{ $localidad['Id_Localidad'] }}">{{ $localidad['Nombre_Localidad'] }}</option>
										        					@endforeach
										        				</select>
										        			</div>
										        		</div>
										        		<div class="col-xs-12 col-md-6">
										        			<div class="form-group">
										        				<input type="hidden" name="ParqueX" id="ParqueX" value="">
										        				<label class="control-label" for="Cedula">* Parque </label>
										        				<select name="Parque" id="Parque" class="selectpicker form-control" data-live-search="true">
										        					<option value="">Seleccionar</option>
										        				</select>
										        			</div>
										        		</div>
										        		<div class="col-xs-12 col-md-6 div_otro_parque"  >
										        			<div class="form-group" >
										        			</div>
										        		</div>
										        		<div class="col-xs-12 col-md-6 div_otro_parque">
										        			<div class="form-group" >
										        				<label class="control-label" for="d_Actividad">* Otro</label>
										        				<input type="text" name="otro_Parque" value="" class="form-control">
										        			</div>
										        		</div>

										        		<div class="col-xs-12 col-md-6">
										        			<div class="form-group">
										        				<label class="control-label" for="Id_TipoDocumento">* Caracteristica Lugar </label>
										        				<textarea class="form-control" rows="3" name="Caracteristica_Lugar"></textarea>
										        			</div>
										        		</div>
										        		

										        		<div class="col-xs-12 col-md-6">
										        			<div class="form-group">
										        				<label class="control-label" for="Id_TipoDocumento">* Caracteristica de la población </label>
										        				<textarea class="form-control" rows="3" name="Caracteristica_poblacion"></textarea>
										        			</div>
										        		</div>

										        		<div class="col-xs-12 col-md-6">
										        			<div class="form-group">
										        			    <label class="control-label" for="Id_TipoDocumento">* Institución, grupo, comunidad</label>
										        				<input type="text" name="Institucion_Grupo" class="form-control">
										        			</div>
										        		</div>

										        		<div class="col-xs-12 col-md-6">
										        			<div class="form-group">
										        			    <label class="control-label" for="Id_TipoDocumento">* Numero de asistentes</label>
										        				<input type="text" name="Numero_Asistentes" class="form-control">
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
										        				<div class='input-group date' id='datetimepicker3_m'>
																	<input type='text' name="Hora_Implementacion" class="form-control" value=""  />
																	<span class="input-group-addon"><span class="glyphicon glyphicon-time"></span>
																	</span>
																</div>
										        			</div>
										        		</div>
										        		<div class="col-xs-12 col-md-6">
										        			<div class="form-group">
										        				<label class="control-label" for="Cedula">* Nombre persona contacto </label>
										        				<input type="text" name="Persona_Contacto" class="form-control">
										        			</div>
										        		</div>

										        		<div class="col-xs-12 col-md-6">
										        			<div class="form-group">
										        				<label class="control-label" for="Id_TipoDocumento">* Roll de la comunidad </label>
										        				<input type="text" name="Roll_Comunidad" class="form-control">
										        			</div>
										        		</div>
										        		<div class="col-xs-12 col-md-6">
										        			<div class="form-group">
										        				<label class="control-label" for="Id_TipoDocumento">* Telefono</label>
										        				<input type="text" name="Telefono" class="form-control">
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
					        <input type="hidden" name="Id_Actividad" class="form-control">
					      	<input type="hidden" name="Dato_Actividad" class="form-control">
					      	<input type="hidden" name="Personas_Acompanates" class="form-control">
					        <button type="submit" id="Modificar_Act" class="btn btn-primary">Modificar</button>
					        <button type="submit" id="Cerrar_Act" class="btn btn-default">Cerrar</button>
					        <div "Mensaje_estado"></div>
					      </div>
					    </div>
					    <br><br> 
					   
			</div>
			</form> 
	  </div>
  	</div>
</div> 


<div class="modal fade bs-example-modal-lg" id="modalMensaj" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
	<div class="modal-dialog modal-lg" role="document">
	   <div class="modal-content">
	   		<div id="mensajeModifica"></div>
		</div>
  	</div>
</div> 


												<div class="modal fade bs-example-modal-lg" id="actividad_modificada" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
												  <div class="modal-dialog modal-lg">
												    <div class="modal-content">
												        
													     <div class="modal-body">
												      			
															<div class="alert alert-success">
																Actividad modificada satisfactoriamente.
															</div>
				
														  </div>
													      <div class="modal-footer" id="cerrar_actividad">
													        <button type="button"  data-funcion="cerrar" class="btn btn-default" data-dismiss="modal">Cerrar</button>
													      </div>
												    </div>
												  </div>
												</div>
												<br><br>

@stop
