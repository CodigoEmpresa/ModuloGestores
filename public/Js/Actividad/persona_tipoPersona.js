//'<a data-role="editar" data-rel="'+e['Id_Persona']+'" class="pull-right btn btn-primary btn-xs">'+
var SelecTipo = '';
$(function(){
	var URL = $('#main_tipoPersona').data('url');
	function buscar(e){		
        var key = $('input[name="buscador"]').val();
            $('#buscar span').removeClass('glyphicon-search').addClass('glyphicon-remove');
            $('#buscar').data('role', 'reset');
            $.get(URL+'/service/buscar/'+key,{}, function(data){
                if(data.length > 0){
                    var html = '';
                    $.each(data, function(i, e){
                    	document.getElementById("resultado").style.display = "block";
                            html +='<div class="list-group-item"> <h5 class="list-group-item-heading">'+
                            			e['Primer_Apellido'].toUpperCase()+' '+e['Segundo_Apellido'].toUpperCase()+' '+e['Primer_Nombre'].toUpperCase()+' '+e['Segundo_Nombre'].toUpperCase()+''+
                            		'</h5>'+
                                    '<div class="row">'+	                                   
                                        '<div class="col-xs-12 col-md-4">'+
                                            '<div class="row">'+
                    	                        '<div class="col-xs-12 col-sm-6 col-md-3"><small>Identificación: '+e.tipo_documento['Nombre_TipoDocumento']+' '+e['Cedula']+'</small></div>'+
                                            '</div>'+
                                        '</div>'+
                                        '<div class="col-xs-12 col-md-4">'+
                                            '<div class="row">'+
                    	                        '<label class="control-label" for="Id_TipoDocumento">Tipo de persona</label>'+
                    	                        '<select name="Id_Tipo'+e.Id_Persona+'" id="Id_Tipo'+e.Id_Persona+'" class="form-control">'+
                    	                        	SelecTipo +
                    	                        '</select>'+
                                            '</div>'+
                                        '</div>'+
                                        '<div class="col-xs-12 col-md-4">'+
				        					'<div class="form-group text-center">'+
				        						'<button type="button" class="btn btn-primary" onclick="Agregar('+e.Id_Persona+');">Agregar</button>'+
				        					'</div>'+
				        				'</div>'+
                                    '</div></div><br>';
                    });
                    $('#personas').html(html);
                    $('#paginador').fadeOut();
                }else{
                	document.getElementById("resultado").style.display = "block";
                    $('#buscar span').removeClass('glyphicon-refresh').addClass('glyphicon-remove');
                    $('#buscar span').empty();
                    document.getElementById("buscar").disabled = false;
                    $('#personas').html( '<li class="list-group-item" style="border:0"><div class="row"><h4 class="list-group-item-heading">No se encuentra ninguna persona registrada con estos datos.</h4></dvi><br>');
                    $('#paginador').fadeOut();
                }
            },'json').done(function(){
                $('#buscar span').removeClass('glyphicon-refresh').addClass('glyphicon-remove');
                $('#buscar span').empty();
                document.getElementById("buscar").disabled = false;
            });
    }

	$('#buscar').on('click', function(e){
        $("#mensajeIncorrectoB").empty();
        $("#mensaje-incorrectoB").fadeOut();
        $("#buscador").css({ 'border-color': '#CCCCCC' });    
        $("#buscar").css({ 'border-color': '#CCCCCC' });    
        var key = $('input[name="buscador"]').val();
        if((!key || key.length <= 6) && $(this).data('role') == 'buscar'){
            $("#buscador").css({ 'border-color': '#B94A48' });
            $("#buscar").css({ 'border-color': '#B94A48' });
            var texto = $("#mensajeIncorrectoB").html();

            $("#mensajeIncorrectoB").html(texto + '<br>' + 'Debe ingresar más de seis (6) dígitos para realizar la búsqueda.');
            $("#mensaje-incorrectoB").fadeIn();
            $('#mensaje-incorrectoB').focus();            
            return false;
        }        
        var role = $(this).data('role');               
        
        switch(role){
            case 'buscar':                
                $('#buscar span').removeClass('glyphicon-search').addClass('glyphicon-refresh');
                $('#buscar span').append(' Cargando...');
                document.getElementById("buscar").disabled = true;
                document.getElementById("buscador").disabled = true;
                $(this).data('role', 'reset');
                SelecTipo = '';
                
		    	$.get('tipo_modulo', function(Stipo){
					SelecTipo += '<option value="">Seleccionar</option>';
					$.each(Stipo, function(i, e){
						SelecTipo +='<option value="'+e.Id_Tipo+'">'+e.Nombre+'</option>';
					});		
							
				}).done(function(){
					buscar(e);          
				});

                
            break;
            case 'reset':                 
                $('#buscar span').removeClass('glyphicon-remove').addClass('glyphicon-refresh');
                $('#buscar span').append(' Cargando...');
                document.getElementById("buscar").disabled = true;
                document.getElementById("buscador").disabled = true;
                $(this).data('role', 'buscar');
                reset(e);
            break;
        }
    });

	function reset(e){
		document.getElementById("resultado").style.display = "none";
        $('input[name="buscador"]').val('');
        $('#buscar span').removeClass('glyphicon-refresh').addClass('glyphicon-search');
        $('#buscar span').empty();
                document.getElementById("buscar").disabled = false;
                document.getElementById("buscador").disabled = false;
        //$('#personas').html($personas_actuales);
        $('#paginador').fadeIn();
    }
});

	function ValidaCampo(e){
	    tecla = (document.all) ? e.keyCode : e.which;
	     if (tecla==8) return true;
	     patron =/[A-Za-z0-9\s]/;
	     te = String.fromCharCode(tecla);
	     return patron.test(te);
	}

	function Agregar(id){
		Id = id;
		Id_Tipo = $("#Id_Tipo"+id).val()
		var token = $("#token").val();
	    var datos = {
            Id: Id,
            Id_Tipo: Id_Tipo,
        }
		$.ajax({
            type: 'POST',
            url: 'ProcesoTipoPersona',
            headers: {'X-CSRF-TOKEN': token},
            dataType: 'json',
            data: datos,        
            success: function (xhr) {  
            	if(xhr.Bandera == 0){
            		$("#Id_Tipo"+id).css({ 'border-color': '#B94A48' });    
            		return false;
            	}else{
            		$("#Id_Tipo"+id).css({ 'border-color': '#CCCCCC' });    
            	}
            	alert(xhr.Mensaje);
            }
        });
	}