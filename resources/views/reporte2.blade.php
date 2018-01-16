@extends('master')                              


@section('script')
	@parent

    <script src="{{ asset('public/Js/Actividad/reporte.js') }}"></script>	
@stop

@section('content') 
        
              
<div class="content" id="reporte" class="row" data-url="Reporte">
            <br>
              <h3 id="navbar">Reporte Datos Actividad</h3>
            <br><br>
           


		<div class="panel panel-primary">
			    <div class="panel-heading">
			    		<h3 class="panel-title">BUSCADOR: buscador para el reporte de datos de la  actvidad.</h3>
			    </div>
			    <div class="panel-body">
					<fieldset>
						<form action="" id="form_reporte2">
							<input type="hidden" name="_token" value="{{ csrf_token() }}"></input>
			        		
			        		<div class="col-xs-12 col-md-6">
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
			        				<label class="control-label" for="Id_Eje">* Eje</label>
			        				<select name="Id_Eje" id="" class="form-control">
			        					<option value="">Seleccionar</option>
			        					@foreach($eje as $eje)
			        						<option value="{{ $eje['Id_Eje'] }}">{{ $eje['Nombre_Eje'] }}</option>
			        					@endforeach
			        				</select>
			        			</div>
			        		</div>
			        		<div class="col-xs-12 col-md-6">
			        			<div class="form-group">
			        				<label class="control-label" for="Id_Tematica">* Componente </label>
			        				<select name="Id_Tematica" id="" class="form-control">
			        					<option value="">Seleccionar</option>¿
			        				</select>
			        			</div>
			        		</div>
			        		<div class="col-xs-12 col-md-6">
			        			<div class="form-group">
			        				<label class="control-label" for="d_Actividad">* Estrategia </label>
			        				<select name="d_Actividad" id="" class="form-control">
			        					<option value="">Seleccionar</option>
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
		    	<h3 class="panel-title">REPORTE: Identifica el número total de actividades realizadas de acuerdo al filtro inicial.</h3>
		    </div>
		    <div id="contenido_reporte2"></div>
		  	
		</div>
</div>



@stop