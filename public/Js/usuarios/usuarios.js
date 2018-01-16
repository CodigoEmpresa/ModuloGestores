$(function()
{
    var URL = $('#main_persona').data('url');
    var $personas_actuales = $('#personas').html();

    function reset(e){
        $('input[name="buscador"]').val('');
        $('#buscar span').removeClass('glyphicon-refresh').addClass('glyphicon-search');
        $('#buscar span').empty();
                document.getElementById("buscar").disabled = false;
                document.getElementById("buscador").disabled = false;
        $('#personas').html($personas_actuales);
        $('#paginador').fadeIn();
    }

    function buscar(e){
        var key = $('input[name="buscador"]').val();
            $('#buscar span').removeClass('glyphicon-search').addClass('glyphicon-remove');
            $('#buscar').data('role', 'reset');
            $.get(URL+'/service/buscar/'+key,{}, function(data){
                if(data.length > 0){
                    var html = '';
                    $.each(data, function(i, e){
                        html += '<li class="list-group-item">'+
                                '<h5 class="list-group-item-heading">'+
                                    ''+e['Primer_Apellido'].toUpperCase()+' '+e['Segundo_Apellido'].toUpperCase()+' '+e['Primer_Nombre'].toUpperCase()+' '+e['Segundo_Nombre'].toUpperCase()+''+
                                    '<a data-role="editar" data-rel="'+e['Id_Persona']+'" class="pull-right btn btn-primary btn-xs">'+
                                        '<span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>'+
                                    '</a>'+
                                '</h5>'+
                                '<p class="list-group-item-text">'+
                                    '<div class="row">'+
                                        '<div class="col-xs-12">'+
                                            '<div class="row">'+
                                                '<div class="col-xs-12 col-sm-6 col-md-3"><small>Identificación: '+e.tipo_documento['Nombre_TipoDocumento']+' '+e['Cedula']+'</small></div>'+
                                            '</div>'+
                                        '</div>'+
                                    '</div>'+
                                '</p>'+
                            '</li>';
                    });
                    $('#personas').html(html);
                    $('#paginador').fadeOut();
                }else{
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
    
    function popular_ciudades(id){
        $.ajax({
            url: URL+'/service/ciudad/'+id,
            data: {},
            dataType: 'json',
            success: function(data){
                var html = '<option value="">Seleccionar</option>';
                if(data.length > 0){
                    $.each(data, function(i, e){
                        html += '<option value="'+e['Nombre_Ciudad']+'">'+e['Nombre_Ciudad']+'</option>';
                    });
                }
                $('select[name="Nombre_Ciudad"]').html(html).val($('select[name="Nombre_Ciudad"]').data('value'));
            }
        });
    }

    function popular_modal_persona(persona){
        $('select[name="Id_TipoDocumento"]').val(persona['Id_TipoDocumento']);
        $('input[name="Cedula"]').val($.trim(persona['Cedula']));
        $('input[name="Primer_Apellido"]').val($.trim(persona['Primer_Apellido']));
        $('input[name="Segundo_Apellido"]').val(persona['Segundo_Apellido']);
        $('input[name="Primer_Nombre"]').val($.trim(persona['Primer_Nombre']));
        $('input[name="Segundo_Nombre"]').val($.trim(persona['Segundo_Nombre']));
        $('input[name="Fecha_Nacimiento"]').val($.trim(persona['Fecha_Nacimiento']));
        $('select[name="Id_Etnia"]').val(persona['Id_Etnia']);
        $('select[name="Nombre_Ciudad"]').data('value', persona['Nombre_Ciudad']);
        $('select[name="Id_Pais"]').val(persona['Id_Pais']).trigger('change');
        $('input[name="Id_Persona"]').val(persona['Id_Persona']);

        $('input[name="Id_Genero"]').removeAttr('checked').parent('.btn').removeClass('active');
        $('input[name="Id_Genero"][value="'+persona['Id_Genero']+'"]').trigger('click');

        $('#modal_form_persona').modal('show');
        $("#crear").button('reset');
    }

    function popular_errores_modal(data){
        $('#form_persona .form-group').removeClass('has-error');
        var selector = '';
        for (var error in data){
            if (typeof data[error] !== 'function') {
                switch(error){
                    case 'tipoDocumento':
                    case 'Id_Etnia':
                    case 'Id_Pais':
                            selector = 'select';
                    break;

                    case 'Cedula':
                    case 'Primer_Apellido':
                    case 'Primer_Nombre':
                    case 'Fecha_Nacimiento':
                    case 'Id_Genero':
                            selector = 'input';
                    break;
                }
                $('#form_persona '+selector+'[name="'+error+'"]').closest('.form-group').addClass('has-error');
            }
        }
        $("#guardar").button('reset');
    }

    //Eventos
    $('input[name="buscador"]').on('keyup', function(e){
        var code = e.which; //http://stackoverflow.com/questions/3462995/jquery-keydown-keypress-keyup-enterkey-detection
        if(code==13) buscar(e);
    });

    $('#buscar').on('click', function(e){
        $("#mensajeIncorrectoB").empty();
        $("#mensaje-incorrectoB").fadeOut();
        $("#buscador").css({ 'border-color': '#CCCCCC' });    
        $("#buscar").css({ 'border-color': '#CCCCCC' });    
        var key = $('input[name="buscador"]').val();
        if(!key && $(this).data('role') == 'buscar'){
            $("#buscador").css({ 'border-color': '#B94A48' });
            $("#buscar").css({ 'border-color': '#B94A48' });
            var texto = $("#mensajeIncorrectoB").html();

            $("#mensajeIncorrectoB").html(texto + '<br>' + 'Debe ingresar un parámetro para realizar la búsqueda.');
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

    $('#crear').on('click', function(e){
        $("#crear").button('loading');
        var persona = {
            Id_TipoDocumento: '',
            Cedula: '',
            Primer_Apellido: '',
            Segundo_Apellido: '',
            Primer_Nombre: '',
            Segundo_Nombre: '',
            Fecha_Nacimiento: '',
            Id_Etnia: '',
            Id_Pais: 41,
            Nombre_Ciudad: '',
            Id_Persona: 0,
            Id_Genero: 0
        }
        popular_modal_persona(persona);
    });

    $('#personas').delegate('a[data-role="editar"]', 'click', function(e){
        var id = $(this).data('rel');
        $.get(URL+'/service/obtener/'+id,{},function(data){	
            if(data)
            {
                popular_modal_persona(data);
            }
        },'json');
    });

    $('#personas').delegate('a[data-role="remover"]', 'click', function(e){
        var id = $(this).data('rel');
    });

    $('select[name="Id_Pais"]').on('change', function(e){
        popular_ciudades($(this).val());
    });

    //Submit formulario único de personas
    $('#form_persona input[name="Cedula"]').on('blur', function(e){
        var key = $(this).val();
        $.get(URL+'/service/buscar/'+key,{}, function(data){
            if(data.length == 1)
            {
                popular_modal_persona(data[0]);
            }
        });
    });

    $('#form_persona').on('submit', function(e){
        $("#guardar").button('loading');
        $.post(URL+'/service/procesar',$(this).serialize(),function(data){
            if(data.status == 'error')
            {
                popular_errores_modal(data.errors);
            } else {
                $('#alerta').show();
                $('#modal_form_persona').modal('hide');
                $("#guardar").button('reset');

                setTimeout(function(){
                    $('#alerta').hide();
                }, 4000)
            }
        },'json');

        e.preventDefault();
    });
});$('#editM span').removeClass('glyphicon-pencil').addClass('glyphicon-remove');

function ValidaCampo(e){
    tecla = (document.all) ? e.keyCode : e.which;
     if (tecla==8) return true;
     patron =/[A-Za-z0-9\s]/;
     te = String.fromCharCode(tecla);
     return patron.test(te);
 }