@extends('master')                              


@section('script')
	@parent

    <script src="{{ asset('public/Js/Actividad/persona_localidad.js') }}"></script>	
@stop

@section('content') 
        
              
<div class="content" id="PersonaLocalidad" class="row" data-url="PersonaLocalidad">
            <br>
            <blockquote>
              <h3 id="navbar">MIS ACTIVIDADES</h3>
            </blockquote>
            <br><br>
		<div class="panel panel-primary">
			  <div class="panel-heading">
			    <h3 class="panel-title">AUTORIZACIÓN DE ACTIVIDADES: Aprobación de actividadesd.</h3>
			  </div>
			  <div class="panel-body">
										<fieldset>
												<form action="" id="form_persona_localidad">
										        		
										        		<div class="col-xs-12 col-md-6">
										        			<div class="form-group">
										        				<label class="control-label" for="Id_TipoDocumento">* Responsable </label>
										        				<select name="Id_Persona" id="" class="form-control">
										        					<option value="">Seleccionar</option>
										        					@foreach($Tipo->personas as $Tipo)
										        						<option value="{{ $Tipo['Id_Persona'] }}">{{ $Tipo['Primer_Apellido'].' '.$Tipo['Segundo_Apellido'].' '.$Tipo['Primer_Nombre'].' '.$Tipo['Segundo_Nombre'] }}</option>
										        					@endforeach
										        				</select>
										        			</div>
										        		</div>

										        		<div class="col-xs-12 col-md-6">
										        			<div class="form-group">
										        				<label class="control-label" for="Id_TipoDocumento">* Localidad</label>
										        				<select name="Id_Localidad" id="" class="form-control">
										        					<option value="">Seleccionar</option>
										        					@foreach($localidad as $localidad)
										        						<option value="{{ $localidad['Id_Localidad'] }}">{{ $localidad['Nombre_Localidad'] }}</option>
										        					@endforeach
										        				</select>
										        			</div>
										        		</div>

										        	

										        		<div class="col-xs-12 col-md-12">
										        			<div class="form-group text-center">
										        				<button type="submit" class="btn btn-primary">Agregar</button>
										        				<button type="submit" id="Ver_P_L" class="btn btn-primary">Ver</button>
										        			</div>
										        		</div>
										        		<div class="col-xs-12 col-md-12">
										        			<div class="form-group text-center">
										        				<div id="esperaAsignacion"></div>
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
			    				
							      		<table id="TablaP" class="display" width="100%" cellspacing="0">
								        <thead>
								            <tr>
								                <th class="text-center">N°</th>
								                <th>Responsable</th>
								                <th>Localidad</th>
								                <th>Eliminar</th>								                
								            </tr>
								        </thead>
								        <tfoot>
								            <tr>
								                <th class="text-center">N°</th>
								                <th>Responsable</th>
								                <th>Localidad</th>
								                <th>Eliminar</th>								                
								            </tr>
								        </tfoot>
								        <tbody id="registro_resposables_localidad">
								        </tbody>
								    </table>
			  </div>
			</div>






@stop
