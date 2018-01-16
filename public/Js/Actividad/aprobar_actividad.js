$(function()

{

	

	var URL = $('#mis_actividad_aprobar').data('url');

	var vector_datos_actividades = new Array();

	vector_datos_ejecucion = new Array();

    vector_novedades = new Array();

    var estado_programacion="";

    var estado_ejecucion="";

    var dehabilitar="";

	$('#form_actividad_aprobar').on('submit', function(e){

				$("#espera1").html("<img src='public/Img/loading.gif'/>");

				$.post(

					URL+'/service/misActividadesGestor',

					$(this).serialize(),

					function(data){

							if(data.status == 'error')

							{

								validador_errores_form(data.errors);

							} else {

								var counter = 1;

									

								if(data.length > 0)

								{

									

									var num=1;

									var html="";

									var Nomparque="";

									t.clear().draw();

									$.each(data, function(i, e){

										

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







										if(jQuery.isEmptyObject(e.parque)){  //No hay informacion parque

											Nomparque="Otro: "+e['Otro'];

										}else{

											Nomparque=e.parque['Nombre'];

										}





										t.row.add( [

								            '<th scope="row" class="text-center">'+num+'</th>',

								            '<td class="text-center"><h4>'+e['Id_Actividad_Gestor']+'<h4></td>',

								            '<td>'+e.persona_programador['Primer_Apellido']+' '+e.persona_programador['Segundo_Apellido']+' '+e.persona_programador['Primer_Nombre']+' '+e.persona_programador['Segundo_Nombre']+'</td>',

								            '<td>'+e.persona['Primer_Apellido']+' '+e.persona['Segundo_Apellido']+' '+e.persona['Primer_Nombre']+' '+e.persona['Segundo_Nombre']+'</td>',

								            '<td>'+e['Fecha_Ejecucion']+'<br>Hora: '+e['Hora_Incial']+'</td>',

								            '<td>'+e.localidad['Nombre_Localidad']+'</td>',

								            '<td>'+Nomparque+'</td>',

								            '<td style="text-align:center "><center><button type="button" data-rel="'+e['Id_Actividad_Gestor']+'" data-funcion="ver_inf" class="'+clase_P+' btn-sm" '+dehabilitar_P+'><span class="glyphicon glyphicon-info-sign" aria-hidden="true"></span> ver</button><div id="espera'+e['Id_Actividad_Gestor']+'"></div></td>',

								            '<td>'+estado_programacion+'</td>',

								            '<td style="text-align:center"><center><button type="button" data-rel="'+e['Id_Actividad_Gestor']+'" data-funcion="ejec_ver" class="'+clase_E+' btn-sm" '+dehabilitar_E+'><span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span> ver</button><div id="espera_eje'+e['Id_Actividad_Gestor']+'"></div></td>',

								            '<td>'+estado_ejecucion+' '+'</td>'

								        ] ).draw( false );



										num++;

									});

								}

							}

							$("#espera1").html("");

					},

					'json'

				);

		e.preventDefault();

	});



	var validador_errores_form = function(data)

	{

		$('#form_actividad_aprobar .form-group').removeClass('has-error');

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

		        $('#form_actividad_aprobar '+selector+'[name="'+error+'"]').closest('.form-group').addClass('has-error');

		    }

		}

	}





     var t = $('#Tabla3').DataTable({

        dom: 'Bfrtip',

        buttons: [

            'copyHtml5',

            'excelHtml5',

            'csvHtml5',

            'pdfHtml5'

        ]

    });



	$('#Tabla3').delegate('button[data-funcion="ver_inf"]','click',function (e) {  

		$("#actividadGestor").empty();

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

    	vector_datos_actividades = new Array();

        tabla = '';

        $.each (datos.datosActividad.datosActividadGestor, function(i, e){

            if(e.Kit == 1){Kit = 'SI';}else if(e.Kit == 2){Kit = 'NO';}

            if(e.Nombre_Actividad == 'OTRO'){Actividad = e.Otro}else{ Actividad=e.Nombre_Actividad;}

            tabla +='<tr>'+

                    '<td>'+e.Nombre_Eje+'</td>'+

                    '<td>'+e.Nombre_Tematica+'</td>'+

                    '<td>'+Actividad+'</td>'+

                    '<td>'+Kit+'</td>'+

                    '<td>'+e.Cantidad_Kit+'</td>'+

                    '<td><button type="button" data-rel="'+e.id+'" data-funcion="modificar_datos" class="btn btn-default btn-sm"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Editar</button></td>'+

                    '</tr>';

            vector_datos_actividades.push({"id_T": e.id, "id_eje": e.eje_id, "id_tematica": e.tematica_id, "id_act": e.actividad_id,"otro_actividad":e.Otro, 'Kit':e.Kit, 'Cantidad_Kit':e.Cantidad_Kit});



        });

        $("#actividadGestor").append('');

        $("#actividadGestor").append(tabla);



        $('textarea[name="Observacion_Cancela"]').css({ 'border-color': '#CCCCCC' });    

        $("#Observacion_CancelaL").css({ 'color': '#555555' });    



        if(datos.datosActividad['Estado']==3 || datos.datosActividad['Estado_Ejecucion']==3){ // Cancelar Prpgramación

				$('#Cancelar_').show(); 	//Ejecucion

				$('#Aprobar_').hide();		//Ejecucion

				$('#Modificar_').hide();	//Ejecucion

		}else{

				$('#Cancelar_').show(); 	//Ejecucion

				$('#Aprobar_').show();		//Ejecucion

				$('#Modificar_').show();	//Ejecucion

		}

		$('input[name="IdLocalidad"]').val(datos.datosActividad['Localidad']);



        $("#titulo_id").text(datos.datosActividad['Id_Actividad_Gestor']);

        $('input[name="Id_Actividad"]').val(datos.datosActividad['Id_Actividad_Gestor']);

        $('select[name="Id_Localidad"]').val(datos.datosActividad['Localidad']).change();

        $('select[name="Id_Responsable"]').val(datos.datosActividad['Id_Responsable']);

        $('input[name="Hora_Inicio"]').val(datos.datosActividad['Hora_Incial']);

        $('input[name="Hora_Fin"]').val(datos.datosActividad['Hora_Final']);

        $('input[name="Fecha_Ejecucion"]').val(datos.datosActividad['Fecha_Ejecucion']);

        if(datos.datosActividad['Parque']==0){$parque="Otro"}else{$parque=datos.datosActividad['Parque'];}

        //$('select[name="Parque"]').selectpicker('val',$parque);

        $('input[name="ParqueX"]').val($parque);

        $('input[name="otro_Parque"]').val(datos.datosActividad['Otro']);

        $('input[name="Caracteristica_Lugar"]').val(datos.datosActividad['Caracteristica_Lugar']);

        $('textarea[name="Caracteristica_poblacion"]').val(datos.datosActividad['Caracteristica_Poblacion']);

        $('textarea[name="Caracteristica_Lugar"]').val(datos.datosActividad['Caracteristica_Lugar']);

        $('textarea[name="Observacion_Cancela"]').val(datos.datosActividad['Observacion_Cancela']);

        $('input[name="Institucion_Grupo"]').val(datos.datosActividad['Instit_Grupo_Comun']);

        $('input[name="Numero_Asistentes"]').val(datos.datosActividad['Numero_Asistente']);

        $('input[name="Hora_Implementacion"]').val(datos.datosActividad['Hora_Implementacion']);

        $('input[name="Persona_Contacto"]').val(datos.datosActividad['Nombre_Contacto']);

        $('input[name="Roll_Comunidad"]').val(datos.datosActividad['Rool_Comunidad']);

        $('input[name="Telefono"]').val(datos.datosActividad['Telefono']);



        $('#modal_form_act_eje').modal('show');

    };



    $('select[name="Parque"]').on('change', function(e){

		var act=$('select[name="Parque"]').val();

		if(act=='Otro'){

			$('.div_otro_parque').show(100);

		}

		else{

			$('.div_otro_parque').hide(100);

			$('input[name="otro_Parque"]').val("");

		}

	

	});





    $('#Tabla3').delegate('button[data-funcion="ejec_ver"]','click',function (e) {  

        var id = $(this).data('rel'); 

        $("#espera_eje"+id).html("<img src='public/Img/loading.gif'/>");

        vector_datos_ejecucion.length=0;

        vector_novedades.length=0;

        $('input[name="Id_Actividad_E"]').val(id);

		$('#table_ejecucion_agregada').hide();

        $.get(

            URL+'/service/obtener/'+id,

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

  		$('#titulo').text(datos.datosActividad['Id_Actividad_Gestor']);

  		$('#FechaRegistro').text(datos.datosActividad['Fecha_Registro_Ejecución']);



  		if(datos.datosActividad['Estado_Ejecucion']==4 || datos.datosActividad['Estado_Ejecucion']==3){ // Aprobado o cancelado 

				$('#Cancelar_e').hide(); 	//Ejecucion

				$('#Aprobar_e').hide();		//Ejecucion

				$('#Modificar_e').hide();	//Ejecucion

		}else{

				$('#Cancelar_e').show(); 	//Ejecucion

				$('#Aprobar_e').show();		//Ejecucion

				$('#Modificar_e').show();	//Ejecucion

		}

  		



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

			fila +="<tr><th scope='row'>"+num+"</th><td>"+e['Comunidad']+"</td><td>"+e.localidad['Nombre_Localidad']+"</td><td>"+e.tipo_entidad['Nombre']+"</td><td>"+e.tipo_persona['Nombre']+"</td><td>"+e.condicion['Nombre']+"</td><td>"+e.situacion['Nombre']+"</td><td>"+e['F_0a5']+"</td><td>"+e['M_0a5']+"</td><td>"+e['F_6a12']+"</td><td>"+e['M_6a12']+"</td><td>"+e['F_13a17']+"</td><td>"+e['M_13a17']+"</td><td>"+e['F_18a26']+"</td><td>"+e['M_18a26']+"</td><td>"+e['F_27a59']+"</td><td>"+e['M_27a59']+"</td><td>"+e['F_60']+"</td><td>"+e['M_60']+"</td><td>"+TotalMujer+"</td><td>"+TotalHombre+"</td><td>"+TotalParcial+"</td></tr>";								            

	        TotalMujerT+=TotalMujer;

	        TotalHombreT+=TotalHombre;

	        num++;

		});

  		 Total=TotalHombreT+TotalMujerT;

		 fila +="<tr><th scope='row'></th><td></td><td></td><td></td><td></td><td></td><td></td><td>"+T_F_0a5+"</td><td>"+T_M_0a5+"</td><td>"+T_F_6a12+"</td><td>"+T_M_6a12+"</td><td>"+T_F_13a17+"</td><td>"+T_M_13a17+"</td><td>"+T_F_18a26+"</td><td>"+T_M_18a26+"</td><td>"+T_F_27a59+"</td><td>"+T_M_27a59+"</td><td>"+T_F_60+"</td><td>"+T_M_60+"</td><td>"+TotalMujerT+"</td><td>"+TotalHombreT+"</td><td>"+Total+"</td></tr>";

		 $('#tablaEjecucion').html(fila);	



		 var num1=1;

		 var fila1="";

		 $.each(datos.Novedad, function(i, e){		

			fila1 +="<tr><th scope='row'>"+num1+"</th><td>"+e['Id_novedad']+"</td><td>"+e['Causa']+"</td><td>"+e['Accion']+"</td></tr>";								            

	        num1++;

		 });

		 $('#tablaNovedad').html(fila1);	



	//	 if(datos.datosActividad.calificaciom_servicio.length>0){

			 $('input[name="nombreRepresentante"]').val(datos.datosActividad.calificaciom_servicio[0]['Nombre_Representante']);

			 $('input[name="telefonoRepresentante"]').val(datos.datosActividad.calificaciom_servicio[0]['Telefono']);

			 $('select[name="puntualidad"]').val(datos.datosActividad.calificaciom_servicio[0]['Id_Puntualidad']);//Manejo del tema

			 $('select[name="divulgacion"]').val(datos.datosActividad.calificaciom_servicio[0]['Id_Divulgacion']);//Material Utulizado

			 $('select[name="escenarioMontaje"]').val(datos.datosActividad.calificaciom_servicio[0]['Id_Montaje']);//Conocimiento adquirido

			 $('#imagenVer1').prop('src','public/Img/EvidenciaFotografica/'+datos.datosActividad.calificaciom_servicio[0]['Url_Imagen1']);//Conocimiento adquirido attr

			 $('#imagenVer2').prop('src','public/Img/EvidenciaFotografica/'+datos.datosActividad.calificaciom_servicio[0]['Url_Imagen2']);//Conocimiento adquirido attr

			 $('#imagenVer3').prop('src','public/Img/EvidenciaFotografica/'+datos.datosActividad.calificaciom_servicio[0]['Url_Imagen3']);//Conocimiento adquirido attr

			 $('#imagenVer4').prop('src','public/Img/EvidenciaFotografica/'+datos.datosActividad.calificaciom_servicio[0]['Url_Imagen4']);//Conocimiento adquirido attr

			 $('#file1').attr('href','public/Img/EvidenciaArchivo/'+datos.datosActividad.calificaciom_servicio[0]['Url_Asistencia']);//Conocimiento adquirido attr

			 $('#file2').attr('href','public/Img/EvidenciaArchivo/'+datos.datosActividad.calificaciom_servicio[0]['Url_Acta']);//Conocimiento adquirido attr			 

	//	 }

		 $('#modal_ejecucion').modal('show');

    };



    $('#Modificar_').on('click', function(e){    	

    	var datos_acti = JSON.stringify(vector_datos_actividades);

        $('input[name="Dato_Actividad"]').val(datos_acti);

        var num=1;

        $.post(

            URL+'/service/ModificarActividad',

            $("#form_actividad_mm").serialize(),

            function(data){

                    if(data.status == 'error')

                    {

                        validador_errores(data.errors);

                    } else {



                    	$('#form_actividad_mm .form-group').removeClass('has-error');

						$('#mensajeModifica').html('<div class="alert alert-dismissible alert-success" ><strong>Exito!</strong> Dato modificado de la actividad con exito. </div>');								$('#modalMensaj').modal('show');

						setTimeout(function(){

							$('#modal_form_act_eje').modal('hide');

							$('#modalMensaj').modal('hide');

						}, 3000)      



						actulaizarTabla();                     	

                    }

            },

            'json'

        );

        e.preventDefault();

        return false;

    });





    function actulaizarTabla(){

    	$("#espera1").html("<img src='public/Img/loading.gif'/>");

								$.post(

									URL+'/service/misActividadesGestor',

									$("#form_actividad_aprobar").serialize(),

									function(data){

											if(data.status == 'error')

											{

												validador_errores_form(data.errors);

											} else {

												var counter = 1;

													

												if(data.length > 0)

													{

														

														var num=1;

														var html="";

														var Nomparque="";

														t.clear().draw();

														$.each(data, function(i, e){

															

															

															

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







															if(jQuery.isEmptyObject(e.parque)){  //No hay informacion parque

																Nomparque="Otro: "+e['Otro'];

															}else{

																Nomparque=e.parque['Nombre'];

															}





															t.row.add( [

													            '<th scope="row" class="text-center">'+num+'</th>',

													            '<td class="text-center"><h4>'+e['Id_Actividad_Gestor']+'<h4></td>',

													            '<td>'+e.persona_programador['Primer_Apellido']+' '+e.persona_programador['Segundo_Apellido']+' '+e.persona_programador['Primer_Nombre']+' '+e.persona_programador['Segundo_Nombre']+'</td>',

													            '<td>'+e.persona['Primer_Apellido']+' '+e.persona['Segundo_Apellido']+' '+e.persona['Primer_Nombre']+' '+e.persona['Segundo_Nombre']+'</td>',

													            '<td>'+e['Fecha_Ejecucion']+'<br>Hora: '+e['Hora_Incial']+'</td>',

													            '<td>'+e.localidad['Nombre_Localidad']+'</td>',

													            '<td>'+Nomparque+'</td>',

													            '<td style="text-align:center "><center><button type="button" data-rel="'+e['Id_Actividad_Gestor']+'" data-funcion="ver_inf" class="'+clase_P+' btn-sm" '+dehabilitar_P+'><span class="glyphicon glyphicon-info-sign" aria-hidden="true"></span> ver</button><div id="espera'+e['Id_Actividad_Gestor']+'"></div></td>',

													            '<td>'+estado_programacion+'</td>',

													            '<td style="text-align:center"><center><button type="button" data-rel="'+e['Id_Actividad_Gestor']+'" data-funcion="ejec_ver" class="'+clase_E+' btn-sm" '+dehabilitar_E+'><span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span> ver</button><div id="espera_eje'+e['Id_Actividad_Gestor']+'"></div></td>',

													            '<td>'+estado_ejecucion+' '+'</td>'

													        ] ).draw( false );



															num++;

														});

													}

											}

											$("#espera1").html("");

									},

									'json'

								);

    }



    var validador_errores = function(data)

	{

		$('#form_actividad_mm .form-group').removeClass('has-error');

		var selector = '';

		for (var error in data){

		    if (typeof data[error] !== 'function') {

		        switch(error)

		        {

		        	

		        	case 'Id_Responsable':

		        	case 'Id_Localidad':

		        	case 'Parque':

		        		selector = 'select';

		        	break;



		        	case 'Fecha_Ejecución':

		        	case 'Hora_Inicio':

		        	case 'Hora_Fin':

		        	case 'Institucion_Grupo':

		        	case 'Numero_Asistentes':

		        	case 'Hora_Implementacion':

		        	case 'Persona_Contacto':

		        	case 'Roll_Comunidad':

		        	case 'Telefono':

		        		selector = 'input';

		        	break;



		        	case 'Caracteristica_Lugar':

		        	case 'Caracteristica_poblacion':

		        		selector = 'textarea';

		        	break;

		        }

		        $('#form_actividad_mm '+selector+'[name="'+error+'"]').closest('.form-group').addClass('has-error');

		    }

		}

	}



    $('#Cerrar_c').on('click', function(e){

                $('#modal_form_act_eje').modal('hide');

        		e.preventDefault();

    });



    $('#Aprobar_').on('click', function(e){

    			var id= $('input[name="Id_Actividad"]').val();

    			$.get(

		            URL+'/service/activar/'+id,

		            {},

		            function(data)

		            {   	

		               			$('#mensajeModifica').html("<div class='alert alert-success' role='alert'> <strong>Bien!</strong> La actividad ha sido aprobada.. </div>");

								$('#modalMensaj').modal('show');

								setTimeout(function(){

									$('#modal_form_act_eje').modal('hide');

									$('#modalMensaj').modal('hide');

								}, 3000)

								actulaizarTabla();

		            }

		        );



		        e.preventDefault();

    });







    $('#Cancelar_').on('click', function(e){    	

    	Observacion = $('textarea[name="Observacion_Cancela"]').val();

    	if(!Observacion || Observacion.length <= 0){

    		$('textarea[name="Observacion_Cancela"]').css({ 'border-color': '#B94A48' });    

        	$("#Observacion_CancelaL").css({ 'color': '#B94A48' });    

        	$("#Observacion_Cancela").focus();

    		return false;



    	}else{

    		var id= $('input[name="Id_Actividad"]').val();

    			$.get(

		            URL+'/service/cancelar/'+id+'/'+Observacion,

		            {},

		            function(data)

		            {   

		               			$('#mensajeModifica').html("<div class='alert alert-danger' role='alert'> <strong>Bien!</strong> La actividad ha sido cancelada.. </div>");

								$('#modalMensaj').modal('show');

								setTimeout(function(){

									$('#modal_form_act_eje').modal('hide');

									$('#modalMensaj').modal('hide');

								}, 3000)

								actulaizarTabla();

		            }

		        );



		        e.preventDefault();

	    }	                

    });









    $('#Cerrar_e').on('click', function(e){

                $('#modal_ejecucion').modal('hide');

        		e.preventDefault();

    });



    $('#Aprobar_e').on('click', function(e){

    			var id= $('input[name="Id_Actividad_ejecucion"]').val();

    			$.get(

		            URL+'/service/aprobarEjecucion/'+id,

		            {},

		            function(data)

		            {   	

		               			$('#mensajeModificaEjecu').html("<div class='alert alert-success' role='alert'> <strong>Bien!</strong> La ejecución ha sido aprobada.. </div>");

								$('#modalMensajEjecucion').modal('show');

								setTimeout(function(){

									$('#modal_ejecucion').modal('hide');

									$('#modalMensajEjecucion').modal('hide');

								}, 3000)

								actulaizarTabla();

		            }

		        );



		        e.preventDefault();

    });





    $('#Cancelar_e').on('click', function(e){

    			var id= $('input[name="Id_Actividad_ejecucion"]').val();

    			$.get(

		            URL+'/service/cancelarEjecucion/'+id,

		            {},

		            function(data)

		            {   	

		               			$('#mensajeModificaEjecu').html("<div class='alert alert-danger' role='alert'> <strong>Bien!</strong> La ejecución ha sido cancelada.. </div>");

								$('#modalMensajEjecucion').modal('show');

								setTimeout(function(){

									$('#modal_ejecucion').modal('hide');

									$('#modalMensajEjecucion').modal('hide');

								}, 3000)

								actulaizarTabla();

		            }

		        );



		        e.preventDefault();

    });























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

									"F_60": F_60

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

						$.each(vector_datos_ejecucion, function(i, e){

							html += '<tr><th scope="row" class="text-center">'+num+'</th><td>'+e['Inst_grupo_comu']+'</td><td>'+e['M_0_5']+'</td><td>'+e['F_0_5']+'</td><td class="text-center"><button type="button" data-rel="'+i+'" data-funcion="crear" class="eliminar_dato_actividad"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button></td></tr>';

							num++;

						});

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

								var Id_Actividad_ejecucion=$('input[name="Id_Actividad_ejecucion"]').val();

								var Id_Requisito=$('select[name="Id_Requisito"]').val();

								var causa=$('input[name="causa"]').val();

								var accion=$('input[name="accion"]').val();



								vector_novedades.push({

									"Id_Actividad_ejecucion": Id_Actividad_ejecucion,

									"Id_Requisito": Id_Requisito,

									"causa": causa,

									"accion": accion,

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

							html += '<tr><th scope="row" class="text-center">'+num+'</th><td>'+e['Id_Requisito']+'</td><td>'+e['accion']+'</td><td>'+e['causa']+'</td><td class="text-center"><button type="button" data-rel="'+i+'" data-funcion="eliminar_novedad" class="eliminar_dato_actividad"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button></td></tr>';

							num++;

						});

					}

					$('#registros_novedad').html(html);



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

							html += '<tr><th scope="row" class="text-center">'+num+'</th><td>'+e['Id_Requisito']+'</td><td>'+e['accion']+'</td><td>'+e['causa']+'</td><td class="text-center"><button type="button" data-rel="'+i+'" data-funcion="eliminar_novedad" class="eliminar_dato_actividad"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button></td></tr>';

							num++;

						});

					}

					$('#registros_novedad').html(html);



     }); 



	$('#cerrar_tabla_novedad').on('click', function(e)

	{

			$('#table_novedad_agregada').hide();

			return false;	

	});







	  //FORMULARIO DE EJECUCION : REGISTRO DE LA EJECUCION

    

	$('#registro_agregada').on('click', function(e)

	{

			if(vector_novedades.length > 0 && vector_datos_ejecucion.length > 0 )

			{

				var formData = new FormData($("#form_ejecucion_servicio")[0]);

				formData.append("vector_novedades",vector_novedades);

				formData.append("vector_datos_ejecucion",vector_datos_ejecucion);

		        $.ajax({

		            url: URL+'/service/registro_ejecucion',  

		            type: 'POST',

		            data: formData,

		            contentType: false,

		            processData: false,

		            success: function(data){

						    if(data.status == 'error')

							{

								validador_errores_registroEjecucion(data.errors);

							}

							else 

							{

								$('#registro_agregadaFin').show();

								$('#registro_agregadaFin').html('Se registro las ejecución con exito!.');

								setTimeout(function(){

									$('#registro_agregadaFin').hide();

								}, 2000)

							}

		            }

		        });

			}

			else

			{

				$('#registro_agregada').show();

				$('#registro_agregada').html('Los pasos 1 y 2 son obligatorios, por favor ingresar los datos.');

					setTimeout(function(){

							$('#registro_agregada').hide();

					}, 2000)



			}           

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



	function ChangeLocalidad(id_localidad, seleccion){

            html = '';            

            html += '<option value="">Seleccionar</option>';

            html += '<option value="Otro">OTRO</option>';

            $("#Parque").append('<option value="Otro">Otro</option>');

            $.get(URL+'/service/getParques/'+id_localidad, {}, function(data){ 

                $.each(data,  function(i, e){

                    html += '<option value="'+e.Id+'"">'+e.Nombre+' '+e['Id_IDRD']+'</option>';

                });         

                $("#Parque").html(html).selectpicker('refresh');

            }).done(function(){

                $('select[name="Parque"]').selectpicker('val',$('input[name="ParqueX"]').val());

            });

        }





    $("#Id_Localidad").on('change', function(e){

       ChangeLocalidad($("#Id_Localidad").val(), $("#IdLocalidad").val()); 

    });



    $('select[name="Id_Eje"]').on('change', function(e){

        select_tematicas($(this).val());

    });

    var select_tematicas = function(id)

    { 



        if(id!=''){

            $.ajax({

                url: 'actividad/service/tematica/'+id,

                data: {},

                dataType: 'json',

                beforeSend:function(data){

                    $('select[name="Id_Tematica"]').html('<option value="">Cargando......</option>').val('');

                },

                success: function(data)

                {



                    var html = '<option value="">Seleccionar</option>';

                    if(data.length > 0)

                    {

                        $.each(data, function(i, e){

                            html += '<option value="'+e['Id_Tematica']+'">'+e['Nombre_Tematica']+'</option>';

                        });

                    }

                    $('select[name="Id_Tematica"]').html(html).val($('select[name="Id_Tematica"]').data('value'));

                }

            });

        }else{

                    var html = '<option value="">Seleccionar</option>';

                    $('select[name="Id_Tematica"]').html(html).val($('select[name="Id_Tematica"]').data('value'));

        }



    };

    $('select[name="Id_Tematica"]').on('change', function(e){

        select_actividades($(this).val());

    });

    var select_actividades = function(id)

    {

        if(id!=''){

            $.ajax({

                url: 'actividad/service/actividad/'+id,

                data: {},

                dataType: 'json',

                beforeSend:function(data){

                    $('select[name="d_Actividad"]').html('<option value="">Cargando......</option>').val('');

                },

                success: function(data)

                {



                    var html = '<option value="">Seleccionar</option>';

                    if(data.length > 0)

                    {

                        $.each(data, function(i, e){

                            html += '<option value="'+e['Id_Actividad']+'">'+e['Nombre_Actividad']+'</option>';

                        });

                    }

                    $('select[name="d_Actividad"]').html(html).val($('select[name="d_Actividad"]').data('value'));

                }

            });

        }else{

                    var html = '<option value="">Seleccionar</option>';

                    $('select[name="d_Actividad"]').html(html).val($('select[name="d_Actividad"]').data('value'));

        }

    };



    $('select[name="d_Actividad"]').on('change', function(e){

        var act=$('select[name="d_Actividad"]').val();

        if(act==4 || act==13 || act==19 || act==20){

            $('#div_otro').show(100);

        }

        else{

            $('#div_otro').hide(100);

            $('input[name="otro_Actividad"]').val("");

        }

    

    });



    $('#ver_registros').delegate('button[data-funcion="modificar_datos"]','click',function (e) {    

        var id_T = $(this).data('rel');

        $("#id_T").val(id_T);

        $('select[name="Id_Eje"]').val('');

        $('select[name="Id_Tematica"]').val('');

        $('select[name="d_Actividad"]').val('');

        $('input[name="otro_Actividad"]').val('');

     //   $('input[name="Kit"]:checked').val();        

        $('input[name="Cantidad_Kit"]').val('');   



        $('#datos_modificar').hide(60);

        $('#datos_modificar').delay(500).show(600);

    }); 







     $('#modificar_eje').on('click', function(e){

        var id_eje=$('select[name="Id_Eje"]').val();

        var id_tematica=$('select[name="Id_Tematica"]').val();

        var id_act = $('select[name="d_Actividad"]').val();

        var otro_actividad = $('input[name="otro_Actividad"]').val();

        var Kit = $('input[name="Kit"]:checked').val();        



        var Cantidad_Kit = $('input[name="Cantidad_Kit"]').val();   





        if(id_eje==='' || id_tematica === '' || id_act === '' || id_eje == 0 || id_tematica == 0 || id_act == 0){

            $('#alert_actividad').html('<div class="alert alert-dismissible alert-danger" ><strong>Error!</strong> Debe seleccionar un eje, un componente y una estrategia para poder realizar el registro.</div>');

            $('#mensaje_actividad').show(60);

            $('#mensaje_actividad').delay(2500).hide(600);



        }else{

            if(Kit==='' || !Kit){

                $('#alert_actividad').html('<div class="alert alert-dismissible alert-danger" ><strong>Error!</strong> Debe seleccionar una opción de entrega de Kit para realizar el registro.</div>');

                $('#mensaje_actividad').show(60);

                $('#mensaje_actividad').delay(2500).hide(600);

                return false;

            }   

            if(Kit === 0){

                Cantidad_Kit = 0;

            }           

            if( Kit==1 && Cantidad_Kit === ''){

                $('#alert_actividad').html('<div class="alert alert-dismissible alert-danger" ><strong>Error!</strong> Debe agregar una cantidad de Kit´s para realizar el registro.</div>');

                $('#mensaje_actividad').show(60);

                $('#mensaje_actividad').delay(2500).hide(600);

                return false;

            }



            

            $('#alert_actividad').html('<div class="alert alert-dismissible alert-success" ><strong>Exito!</strong> Dato de la actividad registrado con éxito. </div>');

            $('#mensaje_actividad').show(60);

            $('#mensaje_actividad').delay(1500).hide(600);

            $('#datos_modificar').hide();





            $.each(vector_datos_actividades, function(i, e){

                if(e['id_T']== $('#id_T').val()){

                    num = i;

                }

            });



            vector_datos_actividades.splice(num, 1);

            vector_datos_actividades.push({"id_eje": id_eje, "id_tematica": id_tematica, "id_act": id_act,"otro_actividad":otro_actividad, 'Kit':Kit, 'Cantidad_Kit':Cantidad_Kit});



        }

    });

});