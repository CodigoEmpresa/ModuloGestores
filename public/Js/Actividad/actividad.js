$(function()

{



	var URL = $('#main_actividad').data('url');

	var $personas_actuales = $('#personas').html();





	vector_datos_actividades = new Array();

	vector_acompañantes = new Array();

	$('#radio_kit .btn').on('click', function(e)

	{

		$('input[name="Kit"]').removeAttr('checked');

		$(this).find('input[name="Kit"]').attr('checked', 'checked');

	});



	/*$('#agregar_actividad').on('click', function(e)

	{

			var id_eje=$('select[name="Id_Eje"]').val();

			var id_tematica=$('select[name="Id_Tematica"]').val();

			var id_act = $('select[name="d_Actividad"]').val();

			var otro_actividad = $('input[name="otro_Actividad"]').val();

			var Kit = $('input[name="Kit"]:checked').val();



			var Cantidad_Kit = $('input[name="Cantidad_Kit"]').val();	





			if(id_eje===''){

				$('#alert_actividad').html('<div class="alert alert-dismissible alert-danger" ><strong>Error!</strong> Debe seleccionar un eje para poder realizar el registro.</div>');

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

				vector_datos_actividades.push({"id_eje": id_eje, "id_tematica": id_tematica, "id_act": id_act,"otro_actividad":otro_actividad, 'Kit':Kit, 'Cantidad_Kit':Cantidad_Kit});

			}

			//return false;

	});*/







	$('#ver_datos_actividad').on('click', function(e)

	{

			var html = '';

					if(vector_datos_actividades.length > 0)

					{

						var num=1;

						$.each(vector_datos_actividades, function(i, e){

							html += '<tr><th scope="row" class="text-center">'+num+'</th><td>'+Buscar_Eje(e['id_eje'])+'</td><td>'+Buscar_Tematica(e['id_tematica'])+'</td><td>'+Buscar_Actividad(e['id_act'])+'</td><td>'+e['otro_actividad']+'</td><td class="text-center"><button type="button" data-rel="'+i+'" data-funcion="crear" class="eliminar_dato_actividad"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button></td></tr>';

							num++;

						});

					}

					$('#registros').html(html);



			$('#ver_registros').modal('show');

			return false;

	});



	$('#datos_actividad').delegate('button[data-funcion="crear"]','click',function (e) {   

		var id = $(this).data('rel'); 

	    vector_datos_actividades.splice(id, 1);

	        

	        $('#mensaje_eliminar').html('<div class="alert alert-dismissible alert-success" ><strong>Exito!</strong> Dato eliminado de la actividad con exito. </div>');

	        $('#mensaje_eliminar').show(60);

			$('#mensaje_eliminar').delay(1500).hide(600);

	        var html = '';

					if(vector_datos_actividades.length > 0)

					{

						var num=1;

						$.each(vector_datos_actividades, function(i, e){

							html += '<tr><th scope="row" class="text-center">'+num+'</th><td>'+Buscar_Eje(e['id_eje'])+'</td><td>'+Buscar_Tematica(e['id_tematica'])+'</td><td>'+Buscar_Actividad(e['id_act'])+'</td><td class="text-center"><button type="button" data-rel="'+i+'" data-funcion="crear" class="eliminar_dato_actividad"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button></td></tr>';

							num++;

						});

					}

					$('#registros').html(html);



     }); 





	$('#asignar_acompañante').on('click', function(e)

	{

			var html = '';

			var id=46;

			var check="";



			$.get(

				URL+'/service/persona_tipo/'+id,

				{},

				function(data)

				{



						if(data.length > 0)

						{

							var html = '';

							$.each(data, function(i, e){

								var paso=0;

								if(vector_acompañantes.length>0){

										$.each(vector_acompañantes, function(i, a){

											if(a['acompa']==e['Id_Persona']){

												paso=1;

											}

										});

								}

								if(paso==1){check="checked";}else{check="";}

								html += '<tr><th scope="row">'+e['Primer_Apellido']+' '+e['Segundo_Apellido']+' '+e['Primer_Nombre']+' '+e['Segundo_Nombre']+'</th><td> <div class="checkbox text-center"><label ><input data-rel="'+e['Id_Persona']+'" data-funcion="agregar" type="checkbox" '+check+'></label></div></td><td class="text-center"><span class="glyphicon glyphicon-calendar " aria-hidden="true"></span></td></tr>';

							});

							$('#div_acompañante').html(html);

						}

						$('#ver_acompañante').modal('show');

					

				},

				'json'

			);

			return false;		

	});







	$('#datos_acopañante').delegate('input[data-funcion="agregar"]','click',function (e) {   

		

		var id = $(this).data('rel'); 

		if($(this).is(':checked')) {  

			vector_acompañantes.push({"acompa": id});

		}else {  

			

			arr = jQuery.grep(vector_acompañantes, function( a,i ) {

			   return a.acompa==id;

			},true);

			vector_acompañantes=arr;

        } 



     }); 







	$('select[name="Id_Eje"]').on('change', function(e){

		select_tematicas($(this).val());

	});

	$('select[name="Id_Tematica"]').on('change', function(e){

		select_actividades($(this).val());

	});

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



	var select_tematicas = function(id)

	{ 



		if(id!=''){

			$.ajax({

				url: URL+'/service/tematica/'+id,

				data: {},

				dataType: 'json',

				success: function(data)

				{



					var html = '<option value="">Seleccionar</option>';

					if(data.length > 0)

					{

						$.each(data, function(i, e){
							if(e['estado']==1)
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



	var select_actividades = function(id)

	{



		if(id!=''){

			$.ajax({

				url: URL+'/service/actividad/'+id,

				data: {},

				dataType: 'json',

				success: function(data)

				{



					var html = '<option value="">Seleccionar</option>';

					if(data.length > 0)

					{

						$.each(data, function(i, e){
							if(e['estado']==1)
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







	function Buscar_Eje(id)

	{ 

		var nombre_eje="";

			

			$.ajax({

				url: URL+'/service/Eje/'+id,

				data: {},

				dataType: 'json',

				async: false,

				success: function(data)

				{

					

					nombre_eje = String(data['Nombre_Eje']);

					

				}

			});



			return nombre_eje;

	};





	function Buscar_Tematica(id)

	{ 

		var Nombre_Temat="";

			

			$.ajax({

				url: URL+'/service/Tematica/'+id,

				data: {},

				dataType: 'json',

				async: false,

				success: function(data)

				{

					

					Nombre_Temat = String(data['Nombre_Tematica']);

					

				}

			});



			return Nombre_Temat;

	};







	function Buscar_Actividad(id)

	{ 

		var Nombre_Temat="";

			

			$.ajax({

				url: URL+'/service/Actividad/'+id,

				data: {},

				dataType: 'json',

				async: false,

				success: function(data)

				{

					

					Nombre_Temat = String(data['Nombre_Actividad']);

					

				}

			});



			return Nombre_Temat;

	};









		$('#datetimepicker1').datetimepicker({

                      format: 'HH:mm'

                });

		$('#datetimepicker2').datetimepicker({

                      format: 'HH:mm'

                });

		$('#datetimepicker3').datetimepicker({

                      format: 'HH:mm'

                });







	$('#form_actividad').on('submit', function(e){
		$('#BotonCrear').attr('disabled','disabled');
		var datos_acti = JSON.stringify(vector_datos_actividades);
		var datos_acomp = JSON.stringify(vector_acompañantes);
		$('input[name="Dato_Actividad"]').val(datos_acti);
		$('input[name="Personas_Acompanates"]').val(datos_acomp);

		//if(vector_datos_actividades.length > 0){

				$.post(
					URL+'/service/crearActividad',
					$(this).serialize(),
					function(data){
						
							if(data.status == 'error')
							{
								validador_errores(data.errors);
							} else {
								$('#actividad_creada').modal('show');
								$(".form-control").val('');

							}

							$('#BotonCrear').removeAttr('disabled');
					},
					'json'
				);

	/*	}else{
				
				$('#alerta_actividad_error').show();
				$('#mensaje_alerta_final').html('No se ha registrado ningun dato basico de la actividad. Lo puede registrar en el paso 1.');
				setTimeout(function(){
					$('#alerta_actividad_error').hide();
				}, 4000)
		}*/

		e.preventDefault();

	});



	var validador_errores = function(data)

	{

		$('#form_actividad .form-group').removeClass('has-error');

		var selector = '';

		for (var error in data){

		    if (typeof data[error] !== 'function') {

		        switch(error)

		        {

		        	case 'Id_Responsable':

		        	case 'Id_Localidad':

		        	case 'Parque':

		        	case 'Id_Eje':

		        	case 'Id_Tematica':

		        	case 'd_Actividad':

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

		        	case 'otro_Actividad':

		        	case 'Kit':

		        	case 'Cantidad_Kit':

		        		selector = 'input';

		        	break;



		        	case 'Caracteristica_Lugar':

		        	case 'Caracteristica_poblacion':

		        		selector = 'textarea';

		        	break;

		        }

		        $('#form_actividad '+selector+'[name="'+error+'"]').closest('.form-group').addClass('has-error');

		    }

		}

	}







	$('#cerrar_actividad').delegate('button[data-funcion="cerrar"]','click',function (e) {   

        $(".form-control").val('');

        vector_datos_actividades.length=0;

		vector_acompañantes.length=0;

     }); 





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

            });

        }





    $("#Id_Localidad").on('change', function(e){

       ChangeLocalidad($("#Id_Localidad").val(), $("#IdLocalidad").val()); 

    });

});