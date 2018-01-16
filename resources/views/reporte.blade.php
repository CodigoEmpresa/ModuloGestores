@extends('master')                              


@section('script')
	@parent

    <script src="{{ asset('public/Js/Actividad/reporte.js') }}"></script>	
@stop

@section('content') 
        
              
<div class="content" id="reporte" class="row" data-url="Reporte">
            <br>
              <h3 id="navbar">Reporte Poblacional</h3>
            <br><br>
           


		<div class="panel panel-primary">
			    <div class="panel-heading">
			    		<h3 class="panel-title">BUSCADOR: buscador para el reporte poblacional.</h3>
			    </div>
			    <div class="panel-body">
					<fieldset>
						<form action="" id="form_reporte">
							<input type="hidden" name="_token" value="{{ csrf_token() }}"></input>
			        		
			        		<div class="col-xs-12 col-md-12">
			        			<div class="form-group">
			        				<label class="control-label" for="Id_TipoDocumento">* Localidad </label>
			        				<select name="Localidad" id="Localidad" class="form-control">
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

			        		<div class="col-xs-12 col-md-6">
			        			<div class="form-group">
			        				<label class="control-label" for="Id_TipoDocumento">Fecha Inicio</label>
			        				<input type="text" data-role="datepicker" name="Fecha_Inicio" class="form-control">
			        			</div>
			        		</div>

			        		<div class="col-xs-12 col-md-6">
			        			<div class="form-group">
			        				<label class="control-label" for="Id_TipoDocumento">Fecha Fin</label>
			        				<input type="text" data-role="datepicker" name="Fecha_Fin" class="form-control">
			        			</div>
			        		</div>

			        		<div class="col-xs-12 col-md-12">
			        			<div class="form-group text-center">
			        				<button type="submit" class="btn btn-primary">Generar</button>
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
		    	<h3 class="panel-title">REPORTE:</h3>
		    </div>
		    <div id="contenido_reporte"></div>
		  	
		</div>
</div>



@stop