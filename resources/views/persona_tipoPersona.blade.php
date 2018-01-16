@extends('master')
@section('script')
@parent
    <script src="{{ asset('public/Js/Actividad/persona_tipoPersona.js') }}"></script>	
@stop
@section('content')         
	<input type="hidden" name="_token" value="{{csrf_token()}}" id="token"/>
    <div id="main_tipoPersona" class="row" data-url="{{ url(config('usuarios.prefijo_ruta')) }}"></div>          
	<div class="content" id="TipoPersona" class="row" data-url="TipoPersona">
        <br>
        <blockquote>
	    <h3 id="navbar">ASIGNAR TIPO PERSONA</h3>
	    </blockquote>
        <br><br>
		<div class="panel panel-primary">
			  <div class="panel-heading">
			    <h3 class="panel-title">ASIGNACIÓN TIPO PERSONA: Asignación tipo persona.</h3>
			  </div>
			  <div class="panel-body">
					<fieldset>
						<form action="" id="form_persona_tipoPersona"> 
							<div class="col-xs-12">
								<label class="control-label" for="Id_TipoDocumento">* Persona: </label>
                                <div class="input-group">
                                    <input name="buscador" type="text" class="form-control" placeholder="Buscar" id="buscador"  onkeypress="return ValidaCampo(event);">
                                    <span class="input-group-btn">
                                        <button id="buscar" data-role="buscar" class="btn btn-default" type="button"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>
                                    </span>
                                </div>
                                <div tabindex="-1" id="mensaje-incorrectoB" class=" text-left alert alert-success alert-danger" role="alert" style="display: none; margin-top: 10px;">
                                    <strong>Error </strong> <span id="mensajeIncorrectoB"></span>
                                </div>
                            </div>                            
			        		<br><br><br><br>
				        	<div class="list-group-item  col-xs-12" id="resultado" style="display: none;">
				        		<p class="list-group-item-text">
									<ul class=" list-group" >	
									<br>		                                
	                                	<div class="col-xs-12" id="personas"></div>
	                                </ul>
                                </p>
                        	</div>
				        </form>
					</fieldset>							      	
			  </div>
		</div>   
	</div> 
@stop