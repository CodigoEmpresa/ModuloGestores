$(function()
{
	var URL = $('#mis_actividad_gestores').data('url');
	vector_datos_ejecucion = new Array();
    vector_novedades = new Array();

	$('#form_actividad_gestor').on('submit', function(e){
				$("#espera").html("<img src='public/Img/loading.gif'/>");
				$.post(
					URL+'/service/misActividadesGestor',
					$(this).serialize(),
					function(data){
					//	console.log(data);
							if(data.status == 'error')
							{
								validador_errores_form(data.errors);
							} else {
								var counter = 1;
									
								if(data.length > 0)
								{
									
									var num=1;
									var html="";
									t.clear().draw();
									$.each(data, function(i, e){

										if(e.parque==null){  //No hay informacion
                                            Nomparque="Otro: "+e['Otro'];
                                        }else{
                                            Nomparque=e.parque['Nombre'];
                                        }


                                        var f = new Date();
                                        var fechaActual = new Date(f.getFullYear()+ "," + (f.getMonth() +1) + "," + f.getDate());
                                        var tmp = e['Fecha_Ejecucion'].split('-');
                                        var F_ejecucion = new Date(tmp[0]+ "," + tmp[1]+ "," + tmp[2]);


                                        dehabilitar_P="";
                                        dehabilitar_E="";
                                        clase_P="";
                                        clase_E="";
                                        //Estado Programación: 
										if(e['Estado']==1){//EN ESPERA PROGRAMACION
											estado_programacion="<center><span class='glyphicon glyphicon-eye-close' aria-hidden='true'></span><br>Por revisar<center>";
											clase_P="btn btn-info";
										}
										if(e['Estado']==2){//APROBADO PROGRAMACION
											estado_programacion="<center><span class='glyphicon glyphicon-ok' aria-hidden='true'></span><br>Aprobado<center>";
											clase_P="btn btn-success";
										}
										if(e['Estado']==3){ // CANCELADO
											estado_programacion="<center><span class='glyphicon glyphicon-remove' aria-hidden='true'></span><br>Cancelado<center>";
											clase_P="btn btn-danger";
										}


										//Estado Ejecución: 										
										if(e['Estado_Ejecucion']==1){  //No hay informacion
											estado_ejecucion="<center><span class='glyphicon glyphicon-star-empty' aria-hidden='true'></span><br>Sin información<center>";
											clase_E="btn btn-info";
										}
										if(e['Estado_Ejecucion']==2){  //Hay informacion
											estado_ejecucion="<center><span class='glyphicon glyphicon-star' aria-hidden='true'></span><br>Con información<center>";
											clase_E="btn btn-primary";
										}
										if(e['Estado_Ejecucion']==3){ //Aprobado
											estado_ejecucion="<center><span class='glyphicon glyphicon-ok' aria-hidden='true'></span><br>Aprobado<center>";
											clase_E="btn btn-success";
										}
										if(e['Estado_Ejecucion']==4){ //Cancelado
											estado_ejecucion="<center><span class='glyphicon glyphicon-remove' aria-hidden='true'></span><br>Cancelado<center>";											
											clase_E="btn btn-danger";
										}

										if(e['Estado']==1 && e['Estado_Ejecucion']==1){ 
											dehabilitar_P="";
                                        	dehabilitar_E="disabled";											
										}
										if(e['Estado']==1 && e['Estado_Ejecucion']==2){ 
											dehabilitar_P="";
                                        	dehabilitar_E="disabled";											
										}
										if(e['Estado']==1 && e['Estado_Ejecucion']==3){ 
											dehabilitar_P="";
                                        	dehabilitar_E="disabled";											
										}
										if(e['Estado']==1 && e['Estado_Ejecucion']==4){ 
											dehabilitar_P="";
                                        	dehabilitar_E="disabled";											
										}

										if(e['Estado']==2 && e['Estado_Ejecucion']==1){ 
											dehabilitar_P="";
                                        	dehabilitar_E="disabled";											
										}
										if(e['Estado']==2 && e['Estado_Ejecucion']==2){ 
											dehabilitar_P="";
                                        	dehabilitar_E="";											
										}
										if(e['Estado']==2 && e['Estado_Ejecucion']==3){ 
											dehabilitar_P="";
                                        	dehabilitar_E="";											
										}
										if(e['Estado']==2 && e['Estado_Ejecucion']==4){ 
											dehabilitar_P="";
                                        	dehabilitar_E="";											
										}


										if(e['Estado']==3 && e['Estado_Ejecucion']==1){ 
											dehabilitar_P="";
                                        	dehabilitar_E="disabled";											
										}
										if(e['Estado']==3 && e['Estado_Ejecucion']==2){ 
											dehabilitar_P="";
                                        	dehabilitar_E="";											
										}
										if(e['Estado']==3 && e['Estado_Ejecucion']==3){ 
											dehabilitar_P="";
                                        	dehabilitar_E="";											
										}
										if(e['Estado']==3 && e['Estado_Ejecucion']==4){ 
											dehabilitar_P="";
                                        	dehabilitar_E="";											
										}

										t.row.add( [
								            '<th scope="row" class="text-center">'+num+'</th>',
								            '<td class="text-center"><h4>'+e['Id_Actividad_Gestor']+'<h4></td>',
								            '<td>'+e.persona['Primer_Apellido']+' '+e.persona['Segundo_Apellido']+' '+e.persona['Primer_Nombre']+' '+e.persona['Segundo_Nombre']+'</td>',
								            '<td>'+e['Fecha_Ejecucion']+'<br>Hora: '+e['Hora_Incial']+'</td>',
								            '<td>'+e.localidad['Nombre_Localidad']+'</td>',
								            '<td>'+Nomparque+'</td>',
								            '<td style="text-align:center "><center><button type="button" data-rel="'+e['Id_Actividad_Gestor']+'" data-funcion="ver_inf" class="'+clase_P+' btn-sm" ><span class="glyphicon glyphicon-info-sign" aria-hidden="true"></span> ver</button><div id="espera'+e['Id_Actividad_Gestor']+'"></div></td>',
								            '<td>'+estado_programacion+'</td>',
								            '<td style="text-align:center"><center><button type="button" data-rel="'+e['Id_Actividad_Gestor']+'" data-funcion="ejec_ver" class="'+clase_E+' btn-sm" ><span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span> ver</button><div id="espera_eje'+e['Id_Actividad_Gestor']+'"></div></td>',
								            '<td>'+estado_ejecucion+' '+'</td>'
								        ] ).draw( false );

										num++;
									});
								}
							}
							$("#espera").html("");

					},
					'json'
				);
        
		e.preventDefault();
	});

	var validador_errores_form = function(data)
	{
		$('#form_actividad_gestor .form-group').removeClass('has-error');
		var selector = '';
		for (var error in data){
		    if (typeof data[error] !== 'function') {
		        switch(error)
		        {
		        	case 'Fecha_Inicio':
		        	case 'Fecha_Fin':
		        		selector = 'input';
		        	break;
		        }
		        $('#form_actividad_gestor '+selector+'[name="'+error+'"]').closest('.form-group').addClass('has-error');
		    }
		}
	}


     var t = $('#Tabla2').DataTable({
        dom: 'Bfrtip',
        buttons: [
            'copyHtml5',
            'excelHtml5',
            'csvHtml5',
            'pdfHtml5'
        ]
    });

	$('#Tabla2').delegate('button[data-funcion="ver_inf"]','click',function (e) {  

        var id = $(this).data('rel'); 
        $("#espera"+id).html("<img src='public/Img/loading.gif'/>");
        $.get(
            URL+'/service/obtener/'+id,
            {},
            function(data)
            {   
                if(data)
                {
                	$("#espera"+id).html("");
                    actividad_datos_eje(data);
                }
            },
            'json'
        );

    }); 

    var actividad_datos_eje = function(datos)
    {
        $('input[name="Id_Actividad"]').val(datos.datosActividad['Id_Actividad_Gestor']);
        $('input[name="Id_Localidad"]').val(datos.datosActividad.localidad['Nombre_Localidad']);
        $('input[name="Id_Responsable"]').val(datos.datosActividad.persona['Primer_Apellido']+" "+datos.datosActividad.persona['Segundo_Apellido']+" "+datos.datosActividad.persona['Primer_Nombre']+" "+datos.datosActividad.persona['Segundo_Nombre']);
        $('input[name="Hora_Inicio"]').val(datos.datosActividad['Hora_Incial']);
        $('input[name="Hora_Fin"]').val(datos.datosActividad['Hora_Final']);
        $('input[name="Fecha_Ejecucion"]').val(datos.datosActividad['Fecha_Ejecucion']);
        $('input[name="Parque"]').val(datos.datosActividad.parque['Nombre']);
        $('input[name="Caracteristica_Lugar"]').val(datos.datosActividad['Caracteristica_Lugar']);
        document.form_actividad_mm.Caracteristica_poblacion.value = datos.datosActividad['Caracteristica_Poblacion'];
        document.form_actividad_mm.Caracteristica_Lugar.value = datos.datosActividad['Caracteristica_Lugar'];
        $('input[name="Institucion_Grupo"]').val(datos.datosActividad['Instit_Grupo_Comun']);
        $('input[name="Numero_Asistentes"]').val(datos.datosActividad['Numero_Asistente']);
        $('input[name="Hora_Implementacion"]').val(datos.datosActividad['Hora_Implementacion']);
        $('input[name="Persona_Contacto"]').val(datos.datosActividad['Nombre_Contacto']);
        $('input[name="Roll_Comunidad"]').val(datos.datosActividad['Rool_Comunidad']);
        $('input[name="Telefono"]').val(datos.datosActividad['Telefono']);
        $('#modal_form_act_eje').modal('show');
    };


    $('#Tabla2').delegate('button[data-funcion="ejec_ver"]','click',function (e) {    
    	$('#file1').hide('slow');
		$('#file2').hide('slow');  	
        var id = $(this).data('rel'); 
        $("#espera_eje"+id).html("<img src='public/Img/loading.gif'/>");
        
        vector_datos_ejecucion.length=0;
        vector_novedades.length=0;
        $('#registros_ejecucion_tabla').html('');
        $('#registros_novedad').html('');
        $("#form_ejecucion_datos_actividad")[0].reset();
        $("#form_ejecucion_novedades")[0].reset();
        $("#form_ejecucion_servicio")[0].reset();


        $('input[name="Id_Actividad_E"]').val(id);
		$('#table_ejecucion_agregada').hide();
        $.get(
            URL+'/service/obtenerEjecucion/'+id,
            {},
            function(data)
            {   
                if(data)
                {
                	$("#espera_eje"+id).html("");
                    actividad_ejecucion(data);
                }
            },
            'json'
        );
    }); 

    var actividad_ejecucion = function(datos)
    {
    	
    	$('input[name="Id_Actividad_ejecucion"]').val(datos.datosActividad['Id_Actividad_Gestor']);
    	$('input[name="Id_Actividad_Gestion"]').val(datos.datosActividad['Id_Actividad_Gestor']);
    	if(datos.datosActividad.calificaciom_servicio.length > 0){
    		$('input[name="Id_Calificacion_Servicio"]').val(datos.datosActividad.calificaciom_servicio[0]['Id']);
    	}
    	
  		$('#titulo').text(datos.datosActividad['Id_Actividad_Gestor']);

  		var f = new Date();
        var fechaActual = new Date(f.getFullYear()+ "," + (f.getMonth() +1) + "," + f.getDate());

        var tmp = datos.datosActividad['Fecha_Ejecucion'].split('-');
        var F_ejecucion = new Date(tmp[0]+ "," + tmp[1]+ "," + tmp[2]);

        var dias = parseInt(tmp[2])+2;

        var F_ejecucionT = new Date(tmp[0]+ "," + tmp[1]+ "," + dias);
      
        
        if(datos.datosActividad['Estado']==2 /*&& F_ejecucion <= fechaActual && F_ejecucionT >= fechaActual*/){
        	//console.log('Entro');
            $("#agregar_datos_ejecucion").show();
            $("#agregar_datos_novedades").show();
            $("#agregar_ejecucion").show();
            $("#Cancelar_E").show();
            //$( "#Cerrar_Act" ).removeClass( "btn btn-success" ).addClass( "btn btn-default" );            
        }else{
            $("#agregar_datos_ejecucion").hide();
            $("#agregar_datos_novedades").hide();
            $("#agregar_ejecucion").hide();
        }
        //return false;

        if(datos.datosActividad['Estado_Ejecucion']==4 || datos.datosActividad['Estado_Ejecucion']==3){
			$("#agregar_datos_ejecucion").hide();
            $("#agregar_datos_novedades").hide();
            $("#agregar_ejecucion").hide();	
            $("#Cancelar_E").hide();
            $("#modificar_ejecucion").hide();
		}

		if(datos.datosActividad['Estado_Ejecucion'] == 1){
        	$("#modificar_ejecucion").hide();
        }
        
        /*if(datos != null){
        	$("#agregar_ejecucion").hide();
        }*/

		$('#table_ejecucion_agregada').show();
		var num=1;
		//$('#datos_ejecucion_tabla').empty();
  		var fila="";
  		var TotalMujer=0;
  		var TotalHombre=0;
  		var TotalParcial=0;
  		var T_F_0a5=0;
  		var T_M_0a5=0;
  		var T_F_6a12=0;
  		var T_M_6a12=0;
  		var T_F_13a17=0;
  		var T_M_13a17=0;
  		var T_F_18a26=0;
  		var T_M_18a26=0;
  		var T_F_27a59=0;
  		var T_M_27a59=0;
  		var T_F_60=0;
  		var T_M_60=0;
  		var TotalMujerT=0;
  		var TotalHombreT=0;
  		var Total=0;

  		$('textarea[name="Observacion_Cancela"]').val(datos.datosActividad['Observacion_Cancela_Ejecucion']);

		if(datos.Ejecucion.length > 0){
			$.each(datos.Ejecucion, function(i, e){

	  		    TotalMujer=parseInt(e['F_0a5'])+parseInt(e['F_6a12'])+parseInt(e['F_13a17'])+parseInt(e['F_18a26'])+parseInt(e['F_27a59'])+parseInt(e['F_60']);
	  		    TotalHombre=parseInt(e['M_0a5'])+parseInt(e['M_6a12'])+parseInt(e['M_13a17'])+parseInt(e['M_18a26'])+parseInt(e['M_27a59'])+parseInt(e['M_60']);
				TotalParcial=TotalMujer+TotalHombre;
				T_F_0a5+=parseInt(e['F_0a5']);
				T_M_0a5+=parseInt(e['M_0a5']);
				T_F_6a12+=parseInt(e['F_6a12']);
				T_M_6a12+=parseInt(e['M_6a12']);
				T_F_13a17+=parseInt(e['F_13a17']);
				T_M_13a17+=parseInt(e['M_13a17']);
				T_F_18a26+=parseInt(e['F_18a26']);
				T_M_18a26+=parseInt(e['M_18a26']);
				T_F_27a59+=parseInt(e['F_27a59']);
				T_M_27a59+=parseInt(e['M_27a59']);
				T_F_60+=parseInt(e['F_60']);
				T_M_60+=parseInt(e['M_60']);
				fila +="<tr><th scope='row'>"+num+"</th><td>"+e['Comunidad']+"</td><td>"+e.localidad['Nombre_Localidad']+"</td><td>"+e.tipo_entidad['Nombre']+"</td><td>"+e.tipo_persona['Nombre']+"</td><td>"+e.condicion['Nombre']+"</td><td>"+e.situacion['Nombre']+"</td><td>"+e['F_0a5']+"</td><td>"+e['M_0a5']+"</td><td>"+e['F_6a12']+"</td><td>"+e['M_6a12']+"</td><td>"+e['F_13a17']+"</td><td>"+e['M_13a17']+"</td><td>"+e['F_18a26']+"</td><td>"+e['M_18a26']+"</td><td>"+e['F_27a59']+"</td><td>"+e['M_27a59']+"</td><td>"+e['F_60']+"</td><td>"+e['M_60']+"</td><td>"+TotalMujer+"</td><td>"+TotalHombre+"</td><td>"+TotalParcial+"</td><td class='text-center'><button type='button' data-rel="+i+" data-funcion='eliminar_conteo' class='eliminar_dato_actividad'><span class='glyphicon glyphicon-remove' aria-hidden='true'></span></button></td></tr>";								            
		        TotalMujerT+=TotalMujer;
		        TotalHombreT+=TotalHombre;
		        num++;

		        /************************/
		        vector_datos_ejecucion.push({
					"Id_Actividad_ejecucion": e["id"],
					"Inst_grupo_comu": e["Comunidad"],
					"Localidad_eje": e['Localidad'],
					"Tipo_entidad": e['TipoEntidad'],
					"Tipo_eje": e['Tipo'],
					"Condicion": e['Condicion'],
					"Situacion": e['Situacion'],
					"M_0_5": e['M_0a5'],
					"F_0_5": e["F_0a5"],
					"M_6_12": e['M_6a12'],
					"F_6_12": e['F_6a12'],
					"M_13_17": e["M_13a17"],
					"F_13_17": e["F_13a17"],
					"M_18_26": e['M_18a26'],
					"F_18_26": e['F_18a26'],
					"M_27_59": e['M_27a59'],
					"F_27_59": e['F_27a59'],
					"M_60": e["M_60"],
					"F_60": e["F_60"],
					"N_Localidad_eje": e.localidad['Nombre_Localidad'],
					"N_Tipo_entidad": e.tipo_entidad['Nombre'],
					"N_Tipo_eje": e.tipo_persona['Nombre'],
					"N_Condicion": e.condicion['Nombre'],
					"N_Situacion": e.situacion['Nombre'],
					"Id_Ejecucion": e["id"],
				});
		        /************************/

			});

	  		 Total=TotalHombreT+TotalMujerT;
			 fila +="<tr><th scope='row'></th><td></td><td></td><td></td><td></td><td></td><td></td><td>"+T_F_0a5+"</td><td>"+T_M_0a5+"</td><td>"+T_F_6a12+"</td><td>"+T_M_6a12+"</td><td>"+T_F_13a17+"</td><td>"+T_M_13a17+"</td><td>"+T_F_18a26+"</td><td>"+T_M_18a26+"</td><td>"+T_F_27a59+"</td><td>"+T_M_27a59+"</td><td>"+T_F_60+"</td><td>"+T_M_60+"</td><td>"+TotalMujerT+"</td><td>"+TotalHombreT+"</td><td>"+Total+"</td></tr>";
			 $('#registros_ejecucion_tabla').html(fila);	

			 $('#table_novedad_agregada').show();
			 var num1=1;
			 var fila1="";
			 var Id_Actividad_ejecucion=$('input[name="Id_Actividad_ejecucion"]').val();
			 $.each(datos.Novedad, function(i, e){		
				fila1 +="<tr><th scope='row'>"+num1+"</th><td>"+e.lista_novedad['Nombre']+"</td><td>"+e['Causa']+"</td><td>"+e['Accion']+"</td><td class='text-center'><button type='button' data-rel='"+i+"' data-funcion='eliminar_novedad' class='eliminar_dato_actividad'><span class='glyphicon glyphicon-remove' aria-hidden='true'></span></button></td></tr>";								            
		        num1++;

		        /**************************/
		        vector_novedades.push({
					"Id_Actividad_ejecucion": Id_Actividad_ejecucion,
					"Id_Requisito": e["Id_novedad"],
					"causa": e["Causa"],
					"accion": e["Accion"],
					"N_Requisito": e.lista_novedad['Nombre'],
					"Id_novedad": e["Id"],
				});
		        /**************************/
			 });
		}
		else{
			 $('#table_ejecucion_agregada').hide();
			 $('#table_novedad_agregada').hide();
		}
  		
		 $('#registros_novedad').html(fila1);
		 
		 if(datos.datosActividad.calificaciom_servicio.length>0){
			 $('input[name="nombreRepresentante"]').val(datos.datosActividad.calificaciom_servicio[0]['Nombre_Representante']);
			 $('input[name="telefonoRepresentante"]').val(datos.datosActividad.calificaciom_servicio[0]['Telefono']);
			 $('select[name="puntualidad"]').val(datos.datosActividad.calificaciom_servicio[0]['Id_Puntualidad']);//Manejo del tema
			 $('select[name="divulgacion"]').val(datos.datosActividad.calificaciom_servicio[0]['Id_Divulgacion']);//Material Utulizado
			 $('select[name="escenarioMontaje"]').val(datos.datosActividad.calificaciom_servicio[0]['Id_Montaje']);//Conocimiento adquirido
			 $("#imagenVer1").attr('src',$("#imagenVer1").attr('src')+'public/Img/EvidenciaFotografica/'+datos.datosActividad.calificaciom_servicio[0]['Url_Imagen1']+'?' + (new Date()).getTime());
			 $("#imagenVer2").attr('src',$("#imagenVer2").attr('src')+'public/Img/EvidenciaFotografica/'+datos.datosActividad.calificaciom_servicio[0]['Url_Imagen2']+'?' + (new Date()).getTime());
			 $("#imagenVer3").attr('src',$("#imagenVer3").attr('src')+'public/Img/EvidenciaFotografica/'+datos.datosActividad.calificaciom_servicio[0]['Url_Imagen3']+'?' + (new Date()).getTime());
			 $("#imagenVer4").attr('src',$("#imagenVer4").attr('src')+'public/Img/EvidenciaFotografica/'+datos.datosActividad.calificaciom_servicio[0]['Url_Imagen4']+'?' + (new Date()).getTime());


			 if(datos.datosActividad.calificaciom_servicio[0]['Url_Asistencia'] != ''){
			 	$('#file2').show('slow');
			 }
			 
			 if(datos.datosActividad.calificaciom_servicio[0]['Url_Acta'] != ''){
			 	$('#file1').show('slow');	
			 }
			// console.log(datos.datosActividad.calificaciom_servicio[0]['Url_Acta']);

			 $('#file1').attr('href','public/Img/EvidenciaArchivo/'+datos.datosActividad.calificaciom_servicio[0]['Url_Asistencia']);//Conocimiento adquirido attr
			 $('#file2').attr('href','public/Img/EvidenciaArchivo/'+datos.datosActividad.calificaciom_servicio[0]['Url_Acta']);//Conocimiento adquirido attr			 
			 
		}else{
			$("#imagenVer1").prop('src','');
			 $("#imagenVer2").prop('src','');
			 $("#imagenVer3").prop('src','');
			 $("#imagenVer4").prop('src','');
			 $("#file1").prop('href','');
			 $("#file2").prop('href','');
		}
		$('#modal_ejecucion').modal('show');
    };



    //FORMULARIO DE EJECUCION: DATOS COMUNIDAD
    


	$('#agregar_datos_ejecucion').on('click', function(e)
	{
			$('#table_ejecucion_agregada').hide();
			$.post(
					URL+'/service/datos_actividades',
					$("#form_ejecucion_datos_actividad").serialize(),
					function(data){
						
							if(data.status == 'error')
							{
								validador_errores_datos_eje(data.errors);
							} else {
								validador_errores_datos_eje(data.errors);
								var Id_Actividad_ejecucion=$('input[name="Id_Actividad_ejecucion"]').val();
								var Inst_grupo_comu=$('input[name="Inst_grupo_comu"]').val();
								
								var Localidad_eje=$('select[name="Localidad_eje"]').val();
								var Tipo_entidad=$('select[name="Tipo_entidad"]').val();
								var Tipo_eje=$('select[name="Tipo_eje"]').val();
								var Condicion=$('select[name="Condicion"]').val();
								var Situacion=$('select[name="Situacion"]').val();

								var M_0_5=$('input[name="M_0_5"]').val();
								var F_0_5=$('input[name="F_0_5"]').val();
								var M_6_12=$('input[name="M_6_12"]').val();
								var F_6_12=$('input[name="F_6_12"]').val();
								var M_13_17=$('input[name="M_13_17"]').val();
								var F_13_17=$('input[name="F_13_17"]').val();
								var M_18_26=$('input[name="M_18_26"]').val();
								var F_18_26=$('input[name="F_18_26"]').val();
								var M_27_59=$('input[name="M_27_59"]').val();
								var F_27_59=$('input[name="F_27_59"]').val();
								var M_60=$('input[name="M_60"]').val();
								var F_60=$('input[name="F_60"]').val();

								vector_datos_ejecucion.push({
									"Id_Actividad_ejecucion": Id_Actividad_ejecucion,
									"Inst_grupo_comu": Inst_grupo_comu,
									"Localidad_eje": Localidad_eje,
									"Tipo_entidad": Tipo_entidad,
									"Tipo_eje": Tipo_eje,
									"Condicion": Condicion,
									"Situacion": Situacion,
									"M_0_5": M_0_5,
									"F_0_5": F_0_5,
									"M_6_12": M_6_12,
									"F_6_12": F_6_12,
									"M_13_17": M_13_17,
									"F_13_17": F_13_17,
									"M_18_26": M_18_26,
									"F_18_26": F_18_26,
									"M_27_59": M_27_59,
									"F_27_59": F_27_59,
									"M_60": M_60,
									"F_60": F_60,
									"N_Localidad_eje": $("#Localidad_eje option:selected").text(),
									"N_Tipo_entidad": $("#Tipo_entidad option:selected").text(),
									"N_Tipo_eje": $("#Tipo_eje option:selected").text(),
									"N_Condicion": $("#Condicion option:selected").text(),
									"N_Situacion": $("#Situacion option:selected").text(),
									"Id_Ejecucion": null,
								});

								$('#ejecucion_agregada').show();
								$('#ejecucion_agregada').html('Se registro los datos de la ejecución.');
								setTimeout(function(){
									$('#ejecucion_agregada').hide();
								}, 2000)

							}
					},
					'json'
				);
            
			return false;
		
	});


	var validador_errores_datos_eje = function(data)
	{
		$('#form_ejecucion_datos_actividad .form-group').removeClass('has-error');
		var selector = '';
		for (var error in data){
		    if (typeof data[error] !== 'function') {
		        switch(error)
		        {
		        	case 'Inst_grupo_comu':
		        	case 'M_0_5':
		        	case 'F_0_5':
		        	case 'M_6_12':
		        	case 'F_6_12':
		        	case 'M_13_17':
		        	case 'F_13_17':
		        	case 'M_18_26':
		        	case 'F_18_26':
		        	case 'M_27_59':
		        	case 'F_27_59':
		        	case 'M_60':
		        	case 'F_60':
		        		selector = 'input';
		        	break;

		        	case 'Localidad_eje':
		        	case 'Tipo_entidad':
		        	case 'Tipo_eje':
		        	case 'Condicion':
		        	case 'Situacion':
		        		selector = 'select';
		        	break;

		        }
		        $('#form_ejecucion_datos_actividad '+selector+'[name="'+error+'"]').closest('.form-group').addClass('has-error');
		    }
		}
	}


	$('#ver_datos_tabla_ejecucion').on('click', function(e)
	{
			$('#ejecucion_agregada').hide();
			var html = '';
					if(vector_datos_ejecucion.length > 0)
					{
							var num=1;
							$('.tablaEjecucion').empty();
					  		var fila="";
					  		var TotalMujer=0;
					  		var TotalHombre=0;
					  		var TotalParcial=0;
					  		var T_F_0a5=0;
					  		var T_M_0a5=0;
					  		var T_F_6a12=0;
					  		var T_M_6a12=0;
					  		var T_F_13a17=0;
					  		var T_M_13a17=0;
					  		var T_F_18a26=0;
					  		var T_M_18a26=0;
					  		var T_F_27a59=0;
					  		var T_M_27a59=0;
					  		var T_F_60=0;
					  		var T_M_60=0;
					  		var TotalMujerT=0;
					  		var TotalHombreT=0;
					  		var Total=0;

					  		$.each(vector_datos_ejecucion, function(i, e){	
					  			if(e['F_0_5']==''){e['F_0_5']=0;}
					  			if(e['M_0_5']==''){e['M_0_5']=0;}
					  			if(e['F_6_12']==''){e['F_6_12']=0;}
					  			if(e['M_6_12']==''){e['M_6_12']=0;}
					  			if(e['F_13_17']==''){e['F_13_17']=0;}
					  			if(e['M_13_17']==''){e['M_13_17']=0;}
					  			if(e['F_18_26']==''){e['F_18_26']=0;}
					  			if(e['M_18_26']==''){e['M_18_26']=0;}
					  			if(e['F_27_59']==''){e['F_27_59']=0;}
					  			if(e['M_27_59']==''){e['M_27_59']=0;}
					  			if(e['F_60']==''){e['F_60']=0;}
					  			if(e['M_60']==''){e['M_60']=0;}

					  		    TotalMujer=parseInt(e['F_0_5'])+parseInt(e['F_6_12'])+parseInt(e['F_13_17'])+parseInt(e['F_18_26'])+parseInt(e['F_27_59'])+parseInt(e['F_60']);
					  		    TotalHombre=parseInt(e['M_0_5'])+parseInt(e['M_6_12'])+parseInt(e['M_13_17'])+parseInt(e['M_18_26'])+parseInt(e['M_27_59'])+parseInt(e['M_60']);
								TotalParcial=parseInt(TotalMujer)+parseInt(TotalHombre);
								T_F_0a5+=parseInt(e['F_0_5']);
								T_M_0a5+=parseInt(e['M_0_5']);
								T_F_6a12+=parseInt(e['F_6_12']);
								T_M_6a12+=parseInt(e['M_6_12']);
								T_F_13a17+=parseInt(e['F_13_17']);
								T_M_13a17+=parseInt(e['M_13_17']);
								T_F_18a26+=parseInt(e['F_18_26']);
								T_M_18a26+=parseInt(e['M_18_26']);
								T_F_27a59+=parseInt(e['F_27_59']);
								T_M_27a59+=parseInt(e['M_27_59']);
								T_F_60+=parseInt(e['F_60']);
								T_M_60+=parseInt(e['M_60']);
								fila +="<tr><th scope='row'>"+num+"</th><td>"+e['Inst_grupo_comu']+"</td><td>"+e['N_Localidad_eje']+"</td><td>"+e['N_Tipo_entidad']+"</td><td>"+e['N_Tipo_eje']+"</td><td>"+e['N_Condicion']+"</td><td>"+e['N_Situacion']+"</td><td>"+e['F_0_5']+"</td><td>"+e['M_0_5']+"</td><td>"+e['F_6_12']+"</td><td>"+e['M_6_12']+"</td><td>"+e['F_13_17']+"</td><td>"+e['M_13_17']+"</td><td>"+e['F_18_26']+"</td><td>"+e['M_18_26']+"</td><td>"+e['F_27_59']+"</td><td>"+e['M_27_59']+"</td><td>"+e['F_60']+"</td><td>"+e['M_60']+"</td><td>"+TotalMujer+"</td><td>"+TotalHombre+"</td><td>"+TotalParcial+"</td><td class='text-center'><button type='button' data-rel="+i+" data-funcion='eliminar_conteo' class='eliminar_dato_actividad'><span class='glyphicon glyphicon-remove' aria-hidden='true'></span></button></td></tr>";								            
						        TotalMujerT+=parseInt(TotalMujer);
						        TotalHombreT+=parseInt(TotalHombre);
						        num++;
							});

					  		 Total=parseInt(TotalHombreT)+parseInt(TotalMujerT);
							 fila +="<tr><th scope='row'></th><td></td><td></td><td></td><td></td><td></td><td></td><td>"+T_F_0a5+"</td><td>"+T_M_0a5+"</td><td>"+T_F_6a12+"</td><td>"+T_M_6a12+"</td><td>"+T_F_13a17+"</td><td>"+T_M_13a17+"</td><td>"+T_F_18a26+"</td><td>"+T_M_18a26+"</td><td>"+T_F_27a59+"</td><td>"+T_M_27a59+"</td><td>"+T_F_60+"</td><td>"+T_M_60+"</td><td>"+TotalMujerT+"</td><td>"+TotalHombreT+"</td><td>"+Total+"</td></tr>";
							 $('#registros_ejecucion_tabla').html(fila);	
					}else{
						 $('#registros_ejecucion_tabla').html("<tr><th scope='row'></th><td>No hay registros.</td></tr>");
					}
					$('#registros_ejecucion').html(html);

			$('#table_ejecucion_agregada').show();
			return false;	
	});


	$('#datos_ejecucion_tabla').delegate('button[data-funcion="crear"]','click',function (e) {   
		var id = $(this).data('rel'); 
	    vector_datos_ejecucion.splice(id, 1);
	        
	        var html = '';
					if(vector_datos_ejecucion.length > 0)
					{
						var num=1;
						$.each(vector_datos_ejecucion, function(i, e){
							html += '<tr><th scope="row" class="text-center">'+num+'</th><td>'+e['Inst_grupo_comu']+'</td><td>'+e['M_0_5']+'</td><td>'+e['F_0_5']+'</td><td class="text-center"><button type="button" data-rel="'+i+'" data-funcion="crear" class="eliminar_dato_actividad"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button></td></tr>';
							num++;
						});
					}
					$('#registros_ejecucion').html(html);

     }); 

	$('#datos_ejecucion_tabla').delegate('button[data-funcion="eliminar_conteo"]','click',function (e) {   
		var id = $(this).data('rel'); 
	    vector_datos_ejecucion.splice(id, 1);
	        
	        var html = '';
					if(vector_datos_ejecucion.length > 0)
					{
							var num=1;
							$('.tablaEjecucion').empty();
					  		var fila="";
					  		var TotalMujer=0;
					  		var TotalHombre=0;
					  		var TotalParcial=0;
					  		var T_F_0a5=0;
					  		var T_M_0a5=0;
					  		var T_F_6a12=0;
					  		var T_M_6a12=0;
					  		var T_F_13a17=0;
					  		var T_M_13a17=0;
					  		var T_F_18a26=0;
					  		var T_M_18a26=0;
					  		var T_F_27a59=0;
					  		var T_M_27a59=0;
					  		var T_F_60=0;
					  		var T_M_60=0;
					  		var TotalMujerT=0;
					  		var TotalHombreT=0;
					  		var Total=0;

					  		$.each(vector_datos_ejecucion, function(i, e){	
					  			if(e['F_0_5']==''){e['F_0_5']=0;}
					  			if(e['M_0_5']==''){e['M_0_5']=0;}
					  			if(e['F_6_12']==''){e['F_6_12']=0;}
					  			if(e['M_6_12']==''){e['M_6_12']=0;}
					  			if(e['F_13_17']==''){e['F_13_17']=0;}
					  			if(e['M_13_17']==''){e['M_13_17']=0;}
					  			if(e['F_18_26']==''){e['F_18_26']=0;}
					  			if(e['M_18_26']==''){e['M_18_26']=0;}
					  			if(e['F_27_59']==''){e['F_27_59']=0;}
					  			if(e['M_27_59']==''){e['M_27_59']=0;}
					  			if(e['F_60']==''){e['F_60']=0;}
					  			if(e['M_60']==''){e['M_60']=0;}

					  		    TotalMujer=parseInt(e['F_0_5'])+parseInt(e['F_6_12'])+parseInt(e['F_13_17'])+parseInt(e['F_18_26'])+parseInt(e['F_27_59'])+parseInt(e['F_60']);
					  		    TotalHombre=parseInt(e['M_0_5'])+parseInt(e['M_6_12'])+parseInt(e['M_13_17'])+parseInt(e['M_18_26'])+parseInt(e['M_27_59'])+parseInt(e['M_60']);
								TotalParcial=parseInt(TotalMujer)+parseInt(TotalHombre);
								T_F_0a5+=parseInt(e['F_0_5']);
								T_M_0a5+=parseInt(e['M_0_5']);
								T_F_6a12+=parseInt(e['F_6_12']);
								T_M_6a12+=parseInt(e['M_6_12']);
								T_F_13a17+=parseInt(e['F_13_17']);
								T_M_13a17+=parseInt(e['M_13_17']);
								T_F_18a26+=parseInt(e['F_18_26']);
								T_M_18a26+=parseInt(e['M_18_26']);
								T_F_27a59+=parseInt(e['F_27_59']);
								T_M_27a59+=parseInt(e['M_27_59']);
								T_F_60+=parseInt(e['F_60']);
								T_M_60+=parseInt(e['M_60']);
								fila +="<tr><th scope='row'>"+num+"</th><td>"+e['Inst_grupo_comu']+"</td><td>"+e['Localidad_eje']+"</td><td>"+e['Tipo_entidad']+"</td><td>"+e['Tipo_eje']+"</td><td>"+e['Condicion']+"</td><td>"+e['Situacion']+"</td><td>"+e['F_0_5']+"</td><td>"+e['M_0_5']+"</td><td>"+e['F_6_12']+"</td><td>"+e['M_6_12']+"</td><td>"+e['F_13_17']+"</td><td>"+e['M_13_17']+"</td><td>"+e['F_18_26']+"</td><td>"+e['M_18_26']+"</td><td>"+e['F_27_59']+"</td><td>"+e['M_27_59']+"</td><td>"+e['F_60']+"</td><td>"+e['M_60']+"</td><td>"+TotalMujer+"</td><td>"+TotalHombre+"</td><td>"+TotalParcial+"</td><td class='text-center'><button type='button' data-rel="+i+" data-funcion='eliminar_conteo' class='eliminar_dato_actividad'><span class='glyphicon glyphicon-remove' aria-hidden='true'></span></button></td></tr>";								            
						        TotalMujerT+=parseInt(TotalMujer);
						        TotalHombreT+=parseInt(TotalHombre);
						        num++;
							});
					  		 Total=parseInt(TotalHombreT)+parseInt(TotalMujerT);
							 fila +="<tr><th scope='row'></th><td></td><td></td><td></td><td></td><td></td><td></td><td>"+T_F_0a5+"</td><td>"+T_M_0a5+"</td><td>"+T_F_6a12+"</td><td>"+T_M_6a12+"</td><td>"+T_F_13a17+"</td><td>"+T_M_13a17+"</td><td>"+T_F_18a26+"</td><td>"+T_M_18a26+"</td><td>"+T_F_27a59+"</td><td>"+T_M_27a59+"</td><td>"+T_F_60+"</td><td>"+T_M_60+"</td><td>"+TotalMujerT+"</td><td>"+TotalHombreT+"</td><td>"+Total+"</td></tr>";
							 $('#registros_ejecucion_tabla').html(fila);	
					}else{
						$('#registros_ejecucion_tabla').html("<tr><th scope='row'></th><td>No hay registros.</td></tr>");	
					}
					$('#registros_ejecucion').html(html);

     }); 

	$('#cerrar_tabla_ejecu').on('click', function(e)
	{
			$('#table_ejecucion_agregada').hide();
			return false;	
	});






	  //FORMULARIO DE EJECUCION : DATOS NOVEDADES
    
	$('#agregar_datos_novedades').on('click', function(e)
	{
			$('#table_novedad_agregada').hide();
			$.post(
					URL+'/service/datos_novedades',
					$("#form_ejecucion_novedades").serialize(),
					function(data){
							if(data.status == 'error')
							{
								validador_errores_novedades(data.errors);
							} 
							else
							{
								validador_errores_novedades(data.errors);
								var Id_Actividad_ejecucion=$('input[name="Id_Actividad_ejecucion"]').val();
								var Id_Requisito=$('select[name="Id_Requisito"]').val();
								var causa=$('input[name="causa"]').val();
								var accion=$('input[name="accion"]').val();

								vector_novedades.push({
									"Id_Actividad_ejecucion": Id_Actividad_ejecucion,
									"Id_Requisito": Id_Requisito,
									"causa": causa,
									"accion": accion,
									"N_Requisito": $("#Id_Requisito option:selected").text(),
									"Id_novedad": null,
								});
								$('#novedad_agregada').show();
								$('#novedad_agregada').html('Se registro los datos de la novedad.');
								setTimeout(function(){
									$('#novedad_agregada').hide();
								}, 2000)
							}
					},
					'json'
				);            
			return false;
	});



	var validador_errores_novedades = function(data)
	{
		$('#form_ejecucion_novedades .form-group').removeClass('has-error');
		var selector = '';
		for (var error in data){
		    if (typeof data[error] !== 'function') {
		        switch(error)
		        {
		        	case 'accion':
		        	case 'causa':
		        		selector = 'input';
		        	break;

		        	case 'Id_Requisito':
		        		selector = 'select';
		        	break;

		        }
		        $('#form_ejecucion_novedades '+selector+'[name="'+error+'"]').closest('.form-group').addClass('has-error');
		    }
		}
	}

	$('#ver_datos_tabla_novedades').on('click', function(e)
	{
			$('#novedad_agregada').hide();
			var html = '';
					if(vector_novedades.length > 0)
					{
						var num=1;
						$.each(vector_novedades, function(i, e){
							html += '<tr><th scope="row" class="text-center">'+num+'</th><td>'+e['N_Requisito']+'</td><td>'+e['accion']+'</td><td>'+e['causa']+'</td><td class="text-center"><button type="button" data-rel="'+i+'" data-funcion="eliminar_novedad" class="eliminar_dato_actividad"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button></td></tr>';
							num++;
						});
						$('#registros_novedad').html(html);
					}
					

			$('#table_novedad_agregada').show();
			return false;	
	});

	$('#datos_novedad_tabla').delegate('button[data-funcion="eliminar_novedad"]','click',function (e) {   
		var id = $(this).data('rel'); 
	    vector_novedades.splice(id, 1);	        
	        var html = '';
				if(vector_novedades.length > 0)
				{
					var num=1;
					$.each(vector_novedades, function(i, e){
						html += '<tr><th scope="row" class="text-center">'+num+'</th><td>'+e['N_Requisito']+'</td><td>'+e['accion']+'</td><td>'+e['causa']+'</td><td class="text-center"><button type="button" data-rel="'+i+'" data-funcion="eliminar_novedad" class="eliminar_dato_actividad"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button></td></tr>';
						num++;
					});
					$('#registros_novedad').html(html);
				}else{
					$('#registros_novedad').html("<tr><th scope='row'></th><td>No hay registros.</td></tr>");	
				}
				

     }); 

	$('#cerrar_tabla_novedad').on('click', function(e)
	{
			$('#table_novedad_agregada').hide();
			return false;	
	});



	  //FORMULARIO DE EJECUCION : REGISTRO DE LA EJECUCION
    
	$('#agregar_ejecucion').on('click', function(e)
	{		
			$("#espera_eje").html("<img src='public/Img/loading.gif'/>");
			if(vector_novedades.length > 0 && vector_datos_ejecucion.length > 0 )
			{
				var formData = new FormData($("#form_ejecucion_servicio")[0]);
				var json_vector_novedades = JSON.stringify(vector_novedades);
				formData.append("vector_novedades",json_vector_novedades);

				var json_vector_datos_ejecucion = JSON.stringify(vector_datos_ejecucion);
				formData.append("vector_datos_ejecucion",json_vector_datos_ejecucion);
		        $.ajax({
		            url: URL+'/service/registro_ejecucion',  
		            type: 'POST',
		            data: formData,
		            contentType: false,
		            processData: false,
		            dataType: "json",
		            success: function(data){
						    if(data.status == 'error')
							{
								validador_errores_registroEjecucion(data.errors);
								$("#espera_eje").html("");
							}
							else 
							{
								validador_errores_registroEjecucion(data.errors);
								$('#form_ejecucion_datos_actividad')[0].reset();
								$('#form_ejecucion_novedades')[0].reset();
								$('#form_ejecucion_servicio')[0].reset();
								
								$("#espera_eje").html("");
								$('#registro_agregada_eje_b').show();
								$('#registro_agregada_eje_b').html('Se registro las ejecución con exito!.');
								setTimeout(function(){
									$('#registro_agregada_eje_b').hide();
									$('#modal_ejecucion').modal('hide');
								}, 2000)
							}
		            }
		        });
			}
			else
			{
				$("#espera_eje").html("");
				$('#registro_agregada_eje').show();
				$('#registro_agregada_eje').html('Los pasos 1 y 2 son obligatorios, por favor ingresar los datos.');
					setTimeout(function(){
							$('#registro_agregada_eje').hide();
					}, 2000)

			}           
			return false;
	});

	$('#Cerrar_eje').on('click', function(e)
	{	
		$('#modal_ejecucion').modal('hide');
		return false;
	});




	var validador_errores_registroEjecucion = function(data)
	{
		$('#form_ejecucion_servicio .form-group').removeClass('has-error');
		var selector = '';
		for (var error in data){
		    if (typeof data[error] !== 'function') {
		        switch(error)
		        {
		        	case 'puntualidad':
		        	case 'divulgacion':
		        	case 'escenarioMontaje':
		        	case 'cumplimiento':
		        	case 'variedadCreatividad':
		        	case 'seguridad':
		        		selector = 'select';
		        	break;

		        	case 'nombreRepresentante':
		        	case 'telefonoRepresentante':
		        		selector = 'input';
		        	break;


		        	case 'imagen1':
		        	case 'imagen2':
		        	case 'imagen3':
		        	case 'imagen4':
		        	case 'listaAsistencia':
		        		selector = 'input';
		        	break;
		        }
		        $('#form_ejecucion_servicio '+selector+'[name="'+error+'"]').closest('.form-group').addClass('has-error');
		    }
		}
	}



	$('#Cancelar_E').on('click', function(e){    	
    	Observacion = $('textarea[name="Observacion_Cancela"]').val();
    	if(!Observacion || Observacion.length <= 0){
    		$('textarea[name="Observacion_Cancela"]').css({ 'border-color': '#B94A48' });    
        	$("#Observacion_CancelaL").css({ 'color': '#B94A48' });    
        	$("#Observacion_Cancela").focus();
    		return false;

    	}else{
    		var id= $('input[name="Id_Actividad_E"]').val();
    			$.get(
		            URL+'/service/cancelarE/'+id+'/'+Observacion,
		            {},
		            function(data)
		            {   
               			$('#mensajeModifica').html("<div class='alert alert-success' role='alert'> <strong>Bien!</strong> La ejecución ha sido cancelada.</div>");
						$('#modalMensaj').modal('show');
						setTimeout(function(){
							$('#modal_form_act_eje').modal('hide');
							$('#modalMensaj').modal('hide');
						}, 3000)
		            }
		        );

		        e.preventDefault();
	    }
    });


    $('#modificar_ejecucion').on('click', function(e)
	{		
			$("#espera_eje").html("<img src='public/Img/loading.gif'/>");
			if(vector_novedades.length > 0 && vector_datos_ejecucion.length > 0 )
			{
				var formData = new FormData($("#form_ejecucion_servicio")[0]);
				var json_vector_novedades = JSON.stringify(vector_novedades);
				formData.append("vector_novedades",json_vector_novedades);

				var json_vector_datos_ejecucion = JSON.stringify(vector_datos_ejecucion);
				formData.append("vector_datos_ejecucion",json_vector_datos_ejecucion);
		        $.ajax({
		            url: URL+'/service/modifica_ejecucion',  
		            type: 'POST',
		            data: formData,
		            contentType: false,
		            processData: false,
		            dataType: "json",
		            success: function(data){
						    if(data.status == 'error')
							{
								validador_errores_registroEjecucion(data.errors);
								$("#espera_eje").html("");
							}
							else 
							{
								validador_errores_registroEjecucion(data.errors);
								$('#form_ejecucion_datos_actividad')[0].reset();
								$('#form_ejecucion_novedades')[0].reset();
								$('#form_ejecucion_servicio')[0].reset();
								
								$("#espera_eje").html("");
								$('#registro_agregada_eje_b').show();
								$('#registro_agregada_eje_b').html('Se registro las ejecución con exito!.');
								setTimeout(function(){
									$('#registro_agregada_eje_b').hide();
									$('#modal_ejecucion').modal('hide');
								}, 2000)
							}
		            }
		        });
			}
			else
			{
				$("#espera_eje").html("");
				$('#registro_agregada_eje').show();
				$('#registro_agregada_eje').html('Los pasos 1 y 2 son obligatorios, por favor ingresar los datos.');
					setTimeout(function(){
							$('#registro_agregada_eje').hide();
					}, 2000)

			}           
			return false;
	});

	$('#Cerrar_eje').on('click', function(e)
	{	
		$('#modal_ejecucion').modal('hide');
		return false;
	});
});