@extends('master')                              





@section('script')

	@parent



    <script src="{{ asset('public/Js/Actividad/aprobar_actividad.js') }}"></script>	

@stop



@section('content') 

        

              

<div class="content" id="mis_actividad_aprobar" class="row" data-url="aprobar">

            <br>

            <blockquote>

              <h3 id="navbar">APROBAR ACTIVIDADES </h3>

            </blockquote>

            <br><br>



		<div class="panel panel-primary">

			  <div class="panel-heading">

			    <h3 class="panel-title">AUTORIZACIÓN DE ACTIVIDADES: Aprobación de actividades.</h3>

			  </div>

			  <div class="panel-body">

										<fieldset>

												<form action="" id="form_actividad_aprobar">

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

										        				<div id="espera1"></div>

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

			    				<div class="table-responsive">

							      		<table id="Tabla3" class="display" width="100%" cellspacing="0">

								        <thead>

								            <tr>

								                <th class="text-center">N°</th>

								                <th class="text-center">Id</th>

								                <th>Programador</th>

								                <th>Responsable</th>

								                <th>Fecha Ejecución</th>

								                <th>Localidad</th>

								                <th>Parque / Otro</th>

								                <th>Programación</th>

								                <th>Estado P</th>

								                <th>Ejecución</th>

								                <th>Estado E</th>

								            </tr>

								        </thead>

								        <tfoot>

								            <tr>

								                <th class="text-center">N°</th>

								                <th class="text-center">Id</th>

								                <th>Programador</th>

								                <th>Responsable</th>

								                <th>Fecha Ejecución</th>

								                <th>Localidad</th>

								                <th>Parque / Otro</th>

								                <th>Programación</th>

								                <th>Estado P</th>

								                <th>Ejecución</th>

								                <th>Estado E</th>

								            </tr>

								        </tfoot>

								        <tbody id="registros_actividades_responsable">

								        </tbody>

								    </table>

								</div>

			  </div>

			</div>







  

 <!-- Modal formulario  actividad -->

<div class="modal fade bs-example-modal-lg" id="modal_form_act_eje" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">

	<div class="modal-dialog modal-lg" role="document">

	   <div class="modal-content">



			<form action="" id="form_actividad_mm" name="form_actividad_mm">

					



						<!-- -*************************************************** -->

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

				</div>

            <!-- ***************************************************** -->





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

										        				<input type="hidden" name="IdLocalidad" id="IdLocalidad" value="">

										        				<label class="control-label" for="Id_TipoDocumento">* Localidad</label>

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

					        <button type="submit" id="Cancelar_" class="btn btn-danger">Cancelar</button>

					        <button type="submit" id="Modificar_" class="btn btn-primary">Modificar</button>

					        <button type="submit" id="Aprobar_" class="btn btn-success">Aprobar</button>

					        <button type="submit" id="Cerrar_c" class="btn btn-default">Cerrar</button>

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

										      			<div class="col-xs-12 col-md-6">

										        			<div class="form-group">

										        				<h3>ACTIVIDAD N° <label class="control-label" for="Id_TipoDocumento" id="titulo"></label></h3>

										        			</div>

										        		</div>

										        		<div class="col-xs-12 col-md-6">

										        			<div class="form-group">

										        				<h3>FECHA REGISTRO° <label class="control-label" for="Id_TipoDocumento" id="FechaRegistro"></label></h3>

										        			</div>

										        		</div>



										        		<div class="col-xs-12 col-md-12">

										        			<div class="form-group">

										        				<div class="table-responsive">

																  <table class="table table-bordered" >

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

														            <th colspan="2" rowspan="2">TOTAL</th>

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

														            <tbody id="tablaEjecucion"> 



														            </tbody> 

																  </table>

																</div>

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



						  								<div class="col-xs-12 col-md-12">

										        			<div class="form-group">

										        				<div class="table-responsive">

																  <table class="table table-bordered" >

																  <thead> 

														            <tr> 

														            <th rowspan="2">#</th> 

														            <th rowspan="2">Requisitos que se incumplen</th> 

														            <th rowspan="2">Causas o el porque</th> 

														            <th rowspan="2">Acciones Tomadas</th> 

														            </tr> 

														            </thead> 

														            <tbody id="tablaNovedad"> 



														            </tbody> 

																  </table>

																</div>

										        			</div>

										        		</div>

										      		

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

										        				<label class="control-label" for="Cedula">Manejo del Tema</label><br>

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

										        				<label class="control-label" for="Cedula">Conicimiento adquirido</label>

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

										        					<option value="1">Selecionar</option>

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

										        					<option value="1">Selecionar</option>

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

																	<option value="1">Selecionar</option>

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

															    <!--<input type="file" name="imagen1">-->

															    <p class="help-block">Imagen en formato jpeg,jpg,png,bmp.</p>

															    <img id="imagenVer1" src="" alt="" class="img-thumbnail">

															 </div>

										        		</div>

										        		<div class="col-xs-12 col-md-6">

										        			<div class="form-group">

															    <label for="exampleInputFile">Imagen 2</label>

															    <!--<input type="file" name="imagen2">-->

															    <p class="help-block">Imagen en formato jpeg,jpg,png,bmp.</p>

															    <img id="imagenVer2" src="" alt="" class="img-thumbnail">

															 </div>

										        		</div>

										        		<div class="col-xs-12 col-md-6">

										        			<div class="form-group">

															    <label for="exampleInputFile">Imagen 3</label>

															    <!--<input type="file" name="imagen3">-->

															    <p class="help-block">Imagen en formato jpeg,jpg,png,bmp.</p>

															    <img id="imagenVer3" src="" alt="" class="img-thumbnail">

															 </div>

										        		</div>

										        		<div class="col-xs-12 col-md-6">

										        			<div class="form-group">

															    <label for="exampleInputFile">Imagen 4</label>

															    <!--<input type="file" name="imagen4">-->

															    <p class="help-block">Imagen en formato jpeg,jpg,png,bmp.</p>

															    <img id="imagenVer4" src="" alt="" class="img-thumbnail">

															 </div>

										        		</div>

										        		<div class="col-xs-12 col-md-6">

										        			<div class="form-group">

															    <label for="exampleInputFile">Formato Evaluación</label>

															    <!--<input type="file" name="listaAsistencia">-->

															    <p class="help-block">Archivo en formato pdf</p>

															    <a id="file1" href="" download>

																  <img border="0" src="public/Img/downloadicon.gif" alt="W3Schools" >

																</a>

															 </div>

										        		</div>

										        		<div class="col-xs-12 col-md-6">

										        			<div class="form-group">

															    <label for="exampleInputFile">Listado Entraga de Kits</label>

															    <!--<input type="file" name="acta">-->

															    <p class="help-block">Archivo en formato pdf</p>

															    <a id="file2" href="" download>

																  <img border="0" src="public/Img/downloadicon.gif" alt="W3Schools" >

																</a>

															 </div>

										        		</div>

										        		<div class="col-xs-12 col-md-12">

										        			<div class="form-group">

										        				<br><br>

										        			</div>

										        		</div>

													    <div class="col-xs-12 col-md-12" >

													    <input type="hidden" name="Id_Actividad_E" class="form-control" value="1">

													         <button type="submit" id="Cancelar_e" class="btn btn-danger">Cancelar</button>

													       <!-- <button type="submit" id="Modificar_e" class="btn btn-primary">Modificar</button>-->

													        <button type="submit" id="Aprobar_e" class="btn btn-success">Aprobar</button>

													        <button type="submit" id="Cerrar_e" class="btn btn-default">Cerrar</button>

													    </div>

														<div class="col-xs-12 col-md-12">

																<div class="alert alert-danger alert-dismissible" role="alert" style="display:none;" id="registro_agregada">

																</div>

														</div>

													</form> 									        

										       		</fieldset>

						  </div>

						</div>   

			</div>

	  </div>

  	</div>

</div> 





<div class="modal fade bs-example-modal-lg" id="modalMensajEjecucion" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">

	<div class="modal-dialog modal-lg" role="document">

	   <div class="modal-content">

	   		<div id="mensajeModificaEjecu"></div>

		</div>

  	</div>

</div> 

@stop

