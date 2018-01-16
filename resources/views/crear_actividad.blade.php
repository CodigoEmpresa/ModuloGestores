@extends('master')                              





@section('script')

	@parent



    <script src="{{ asset('public/Js/Actividad/actividad.js') }}"></script>	

@stop



@section('content') 

        

              

<div class="content" id="main_actividad" class="row" data-url="actividad">

    <br>

	<blockquote>

  	<h3 id="navbar">PROGRAMACIÓN DE ACTIVIDADES</h3>

  	</blockquote>

    <br><br>           

	<form action="" id="form_actividad">

		<input type="hidden" name="_token" value="{{ csrf_token() }}"></input>

		<input type="hidden" name="Id_Actividad" value="0"></input>

		<div class="panel panel-primary">

		  <div class="panel-heading">

		    <h3 class="panel-title">PASO 1: Datos básicos de la actividad</h3>

		  </div>

		  <div class="panel-body">

	      		<fieldset>

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

	        		<div class="col-xs-12 col-md-6" style="display: none;" id="div_otro">

	        			<div class="form-group" >

	        				<label class="control-label" for="d_Actividad">* Otro</label>

	        				<input type="text" name="otro_Actividad" value="" class="form-control">

	        			</div>

        			</div>

        			<div class="col-xs-12 col-md-12">

        				<label class="control-label" for="d_Actividad">* Entrega de kit´s </label>

        			</div>



        			<div class="col-xs-12 col-md-6">

            

        			<div class="col-xs-12 col-md-12">

                        <div class="form-group col-md-6">				                                    				                                        

                            <div id="radio_kit" class="btn-group" data-toggle="buttons">

                                <!--<label class="btn btn-default">

                                    <input type="hidden" name="Kit" value="1" autocomplete="off" > <span class="text-success">SI</span>

                                </label>-->

                                <label class="btn btn-default active">

                                    <input type="radio" name="Kit" value="2" autocomplete="off" checked="checked"> <span class="text-danger">NO</span>

                                </label>

                            </div>

                        </div>

                        <div class="form-group col-md-6">				                                    				                                        

        				<!--<label class="control-label" for="d_Actividad">Cantidad </label>-->

        				<input type="hidden" name="Cantidad_Kit" id="Cantidad_Kit" class="form-control" value="0">

        			</div>



	        										        		

	        		</div>

	        		<!--<div class="col-xs-12 col-md-12">

	        			<div class="form-group">

	        				<a href="#" id="agregar_actividad" class="btn btn-info btn-sm">Agregar</a>

	        				<a href="#" id="ver_datos_actividad"class="btn btn-default btn-sm">Ver registros</a>

	        			</div>

	        		</div>-->



	        		 <div class="col-xs-12 col-md-12"  >

	        			<div class="form-group"  id="mensaje_actividad" style="display: none;">

	        			<div id="alert_actividad"></div>

	        			</div>

	        			





	        			<div class="modal fade bs-example-modal-lg" id="ver_registros" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">

						  <div class="modal-dialog modal-lg">

						    <div class="modal-content">

						        <div class="modal-header">

							        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

							        <h4 class="modal-title" id="myModalLabel">Datos de la actividad</h4>

							     </div>

							     <div class="modal-body">

						      			<table class="table table-bordered" id="datos_actividad"> 

										<thead>

										<tr>

										<th>#</th>

										<th>Eje</th>

										<th>Tematica</th>

										<th>Actividad</th>

										<th>Otro</th>

										<th>Eliminar</th>

										</tr>

										</thead>

										<tbody id="registros"> 

										</tbody> 

										</table>

										<div id="mensaje_eliminar"></div>

								  </div>

							      <div class="modal-footer">

							        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>

							      </div>

						    </div>

						  </div>

						</div>



						<div class="modal fade bs-example-modal-lg" id="actividad_creada" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">

						  <div class="modal-dialog modal-lg">

						    <div class="modal-content">

						        

							     <div class="modal-body">

						      			

									<div class="alert alert-success">

										Actividad registrada satisfactoriamente.

									</div>



								  </div>

							      <div class="modal-footer" id="cerrar_actividad">

							        <button type="button"  data-funcion="cerrar" class="btn btn-default" data-dismiss="modal">Cerrar</button>

							      </div>

						    </div>

						  </div>

						</div>	

	        		

	        		</div>

	       		</fieldset>

		  </div>

		</div>

		<br>

		<div class="panel panel-primary">

		  <div class="panel-heading">

		    <h3 class="panel-title">PASO 2: Datos de asignación y configuración horaria</h3>

		  </div>

		  <div class="panel-body">

	      		<fieldset>

	        		<div class="col-xs-12 col-md-6">

	        			<div class="form-group">

	        				<label class="control-label" for="Id_TipoDocumento">* Fecha ejecución</label>

	        				<input type="text" data-role="datepicker" name="Fecha_Ejecucion" class="form-control">

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

	        				<div class='input-group date' id='datetimepicker1'>

								<input type='text' name="Hora_Inicio" class="form-control" value=""  />

								<span class="input-group-addon"><span class="glyphicon glyphicon-time"></span>

								</span>

							</div>

	        			</div>

	        		</div>

	        		<div class="col-xs-12 col-md-6">

	        			<div class="form-group">

	        				<label class="control-label" for="Cedula">* Hora Final </label>

	        				<div class='input-group date' id='datetimepicker2'>

								<input type='text' name="Hora_Fin" class="form-control" value=""  />

								<span class="input-group-addon"><span class="glyphicon glyphicon-time"></span>

								</span>

							</div>

	        			</div>

	        		</div>

	        		<div class="col-xs-12 col-md-12">

	        		    <div class="form-group">

	        		    	<p class="text-muted">Selecione los acompañantes ha esta actividad:</p>

	        				<a href="#" id="asignar_acompañante" class="btn btn-info btn-sm">Acompañantes</a>

	        			</div>

	        			<div class="modal fade bs-example-modal-lg" id="ver_acompañante" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">

						  <div class="modal-dialog modal-lg">

						    <div class="modal-content">

						        <div class="modal-header">

							        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

							        <h4 class="modal-title" id="myModalLabel">Acompañantes de la actividad</h4>

							     </div>

							     <div class="modal-body">

						      			<table class="table table-bordered" id="datos_acopañante"> 

										<thead>

										<tr>

										<th>Usuario</th>

										<th>Selecionar</th>

										<th>Disponibilidad</th>

										</tr>

										</thead>

										<tbody id="div_acompañante"> 

										</tbody> 

										</table>

								  </div>

							      <div class="modal-footer">

							        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

							      </div>

						    </div>

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

	        				<label class="control-label" for="Cedula">* Parque </label>

	        				<select name="Parque" id="Parque" class="selectpicker form-control" data-live-search="true">

	        					<option value="">Seleccionar</option>

	        					

	        				</select>

	        			</div>

	        		</div>

	        		<div class="col-xs-12 col-md-6 div_otro_parque" style="display: none;" >

	        			<div class="form-group" >

	        			</div>

	        		</div>

	        		<div class="col-xs-12 col-md-6 div_otro_parque" style="display: none;">

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

	        			    <label class="control-label" for="Id_TipoDocumento">* Institución, grupo, comunidad</label>

	        				<input type="text" name="Institucion_Grupo" class="form-control">

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

        				<div class='input-group date' id='datetimepicker3'>

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

        				<label class="control-label" for="Id_TipoDocumento">* Roll  </label>

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

	      	<input type="hidden" name="Dato_Actividad" class="form-control">

	      	<input type="hidden" name="Personas_Acompanates" class="form-control">

	        <button type="reset" class="btn btn-default">Cancel</button>

	        <button type="submit" class="btn btn-primary" id="BotonCrear">Crear</button>

	      </div>

	    </div>

	    <br><br> 		   

	</div>

</form>       

            

       

@stop

