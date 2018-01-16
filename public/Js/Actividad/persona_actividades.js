var CBActividades = '';
var ActividadesMod = [];
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
                            html +='<div class="list-group-item">'+
                                        '<h5 class="list-group-item-heading">'+
                            			     e['Primer_Apellido'].toUpperCase()+' '+e['Segundo_Apellido'].toUpperCase()+' '+e['Primer_Nombre'].toUpperCase()+' '+e['Segundo_Nombre'].toUpperCase()+
                                        '</h5>'+
                                        '<div class="row">'+
                	                        '<div class="col-xs-12 col-sm-6 col-md-3"><small>Identificación: '+e.tipo_documento['Nombre_TipoDocumento']+' '+e['Cedula']+'</small></div>'+
                                        '</div>'+
                                        '<div class="row" style="margin-left:10px;" id="actividadesCheck'+e.Id_Persona+'">'+
                                        '</div>'+
                                        '<div class="row">'+
    			        					'<div class="form-group text-center">'+
    			        						'<button disabled type="button" class="btn btn-primary" id="Agregar'+e.Id_Persona+'" onclick="Agregar('+e.Id_Persona+');">Asignar</button>'+
    			        					'</div>'+
    			        				'</div>'+
                                    '</div>'+
                                    '<br><br>';
                            actividadesCheck(e.Id_Persona);
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
    function actividadesCheck(id){        
        $.get('actividadesModulo', function(Stipo){
            CBActividades = '';     
            ActividadesMod = [];
            i=0;
            $.each(Stipo, function(i, e){
                CBActividades +='<input type="checkbox" name="CB'+e.Id_Actividad+'" id="CB'+e.Id_Actividad+'" value="'+e.Id_Actividad+'"/><small>'+e.Nombre_Actividad+'</small><br>';
                ActividadesMod[i] = {'id' : e.Id_Actividad, 'Nombre': e.Nombre_Actividad};
                i=i+1;
            });     
            $('#actividadesCheck'+id).append(CBActividades);            
                    
        }).done(function(){
            $.get('actividadesPersona/'+id, function(act_Per){
                $.each(act_Per, function(i, e){
                    $("#CB"+e.Id_Actividad).prop('checked', true);
                });
                $("#Agregar"+id).prop('disabled', false);
            });      
        });
        
    }

	$('#buscar').on('click', function(e){

        $("#mensajeIncorrectoB").empty();
        $("#mensaje-incorrectoB").fadeOut();
        $("#mensajecorrectoB").empty();
        $("#mensaje-correctoB").fadeOut();
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
                buscar(e);  

                
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
        var ArrayActividades = [];
        for(i=0;i<ActividadesMod.length;i++){
            nombre = '#CB'+ActividadesMod[i].id;
            if($(nombre).is(":checked") == true){                
                ArrayActividades[(ArrayActividades.length)] = {'id_actividad':ActividadesMod[i].id, 'estado': 1};
            }else{
                ArrayActividades[(ArrayActividades.length)] = {'id_actividad':ActividadesMod[i].id, 'estado': 0};
            }
        }
        var token = $("#token").val();
        var datos = {Datos: ArrayActividades, Id: id}
        $.ajax({
            type: 'POST',
            url: 'PersonasActividadesProceso',
            headers: {'X-CSRF-TOKEN': token},
            dataType: 'json',
            data: datos,
            success: function (xhr) {  
                $("#mensajeIncorrectoB").empty();
                $("#mensaje-incorrectoB").fadeOut();
                $("#mensajecorrectoB").empty();
                $("#mensaje-correctoB").fadeOut();
                if(xhr.Bandera == 1){//OK
                    $("#Id_Tipo"+id).css({ 'border-color': '#B94A48' });    
                    $("#mensajecorrectoB").html(xhr.Mensaje);
                    $("#mensaje-correctoB").fadeIn();
                    $('#mensaje-correctoB').focus();            
                    return false;
                }else{
                    $("#Id_Tipo"+id).css({ 'border-color': '#CCCCCC' });    
                    $("#mensajeIncorrectoB").html(xhr.Mensaje);
                    $("#mensaje-incorrectoB").fadeIn();
                    $('#mensaje-incorrectoB').focus();            
                }
            }
        });
    }
