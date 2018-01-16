$(function()
{
	var URL = $('#PersonaLocalidad').data('url');

		$('#form_persona_localidad').on('submit', function(e){
				$("#esperaAsignacion").html("<img src='public/Img/loading.gif'/>");
				$.post(
					URL+'/service/validacionPersonaLocalidad',
					$(this).serialize(),
					function(data){
							if(data.status == 'error')
							{
								validador_errores_form(data.errors);
								$("#esperaAsignacion").html("");

							} else {
								var counter = 1;
									
								if(data.length > 0)
								{
									
									var num=1;
									var html="";
									t.clear().draw();
									$.each(data, function(i, e){
									    $.each(e.localidades, function(i, a){
											t.row.add( [
									            '<th scope="row" class="text-center">'+num+'</th>',
									            '<td>'+e['Primer_Apellido']+' '+e['Segundo_Apellido']+' '+e['Primer_Nombre']+' '+e['Segundo_Nombre']+'</td>',
									            '<td>'+a['Nombre_Localidad']+'</td>',
									            '<td style="text-align:center"><center><button type="button" data-rel="'+a.pivot['id_persona']+'" data-loc="'+a.pivot['id_localidad']+'" data-funcion="borar_rel" class="btn btn-primary btn-sm" ><span class="glyphicon glyphicon-minus-sign" aria-hidden="true"></span>Eliminar</button><div id="espera_eje'+a['id_persona']+a['id_localidad']+'"></div></td>'
									        ] ).draw( false );
									        num++;
										});										
									});

								}
							}
							$("#esperaAsignacion").html("");
					},
					'json'
				);
		e.preventDefault();
	 });

	$('#Ver_P_L').on('click', function(e){
		$("#esperaAsignacion").html("<img src='public/Img/loading.gif'/>");
		$.post(
            URL+'/service/verPersonaLocalidad',
            {},
            function(data)
            {   
                if(data)
                {
                	$("#esperaAsignacion").html("");
                	var num=1;
					var html="";
                    t.clear().draw();
									$.each(data, function(i, e){
									    $.each(e.localidades, function(i, a){
											t.row.add( [
									            '<th scope="row" class="text-center">'+num+'</th>',
									            '<td>'+e['Primer_Apellido']+' '+e['Segundo_Apellido']+' '+e['Primer_Nombre']+' '+e['Segundo_Nombre']+'</td>',
									            '<td>'+a['Nombre_Localidad']+'</td>',
									            '<td style="text-align:center"><center><button type="button" data-rel="'+a.pivot['id_persona']+'" data-loc="'+a.pivot['id_localidad']+'" data-funcion="borar_rel" class="btn btn-primary btn-sm" ><span class="glyphicon glyphicon-minus-sign" aria-hidden="true"></span>Eliminar</button><div id="espera_eje'+a['id_persona']+a['id_localidad']+'"></div></td>'
									        ] ).draw( false );
									        num++;
										});										
									});
                }
            },
            'json'
        );
		e.preventDefault();
	 });

	 $('#TablaP').delegate('button[data-funcion="borar_rel"]','click',function (e) {  
        var id_per =$(this).data('rel'); 
        var id_loc =$(this).data('loc'); 
        
        $("#espera_eje"+id_per+id_loc).html("<img src='public/Img/loading.gif'/>");

        $.post(
            URL+'/service/eliminaPersonaLocalidad',
            {idpersona:id_per,idlocalidad:id_loc},
            function(data)
            {   
                if(data)
                {
                	$("#espera_eje"+id_per+id_loc).html("");
                	var num=1;
					var html="";
                    t.clear().draw();
									$.each(data, function(i, e){
									    $.each(e.localidades, function(i, a){
											t.row.add( [
									            '<th scope="row" class="text-center">'+num+'</th>',
									            '<td>'+e['Primer_Apellido']+' '+e['Segundo_Apellido']+' '+e['Primer_Nombre']+' '+e['Segundo_Nombre']+'</td>',
									            '<td>'+a['Nombre_Localidad']+'</td>',
									            '<td style="text-align:center"><center><button type="button" data-rel="'+a.pivot['id_persona']+'" data-loc="'+a.pivot['id_localidad']+'" data-funcion="borar_rel" class="btn btn-primary btn-sm" ><span class="glyphicon glyphicon-minus-sign" aria-hidden="true"></span>Eliminar</button><div id="espera_eje'+id_per+id_loc+'"></div></td>'
									        ] ).draw( false );
									        num++;
										});										
									});
                }
            },
            'json'
        );
    }); 

	/*REpintar la tabla*/

	var validador_errores_form = function(data)
	{
		$('#form_persona_localidad .form-group').removeClass('has-error');
		var selector = '';
		for (var error in data){
		    if (typeof data[error] !== 'function') {
		        switch(error)
		        {
		        	case 'Id_Persona':
		        	case 'Id_Localidad':
		        		selector = 'select';
		        	break;
		        }
		        $('#form_persona_localidad '+selector+'[name="'+error+'"]').closest('.form-group').addClass('has-error');
		    }
		}
	}

    var t = $('#TablaP').DataTable({
        dom: 'Bfrtip',
        buttons: [
            'copyHtml5',
            'excelHtml5',
            'csvHtml5',
            'pdfHtml5'
        ]
    });


});