$(function()
{
	var URL = $('#reporte').data('url');

	$('#form_reporte').on('submit', function(e){
			$("#contenido_reporte").html("<img src='public/Img/loading.gif'/>");
				
				$.post(
                    URL+'/reporteTipoPoblacional',
                    $(this).serialize(),
                    function(data){
                        $('#contenido_reporte').html(data);
                        $('#Tabla_Reporte').DataTable({
					        dom: 'Bfrtip',
					        buttons: [
					            'copyHtml5',
					            'excelHtml5',
					            'csvHtml5',
					            'pdfHtml5'
					        ]
					    });
                    }
                );

        e.preventDefault();
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

	var select_tematicas = function(id)
	{ 

		if(id!=''){
			$.ajax({
				url: 'actividad/service/tematica/'+id,
				data: {},
				dataType: 'json',
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


	var select_actividades = function(id)
	{

		if(id!=''){
			$.ajax({
				url: 'actividad/service/actividad/'+id,
				data: {},
				dataType: 'json',
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



	$('#form_reporte2').on('submit', function(e){
			$("#contenido_reporte").html("<img src='public/Img/loading.gif'/>");
				
				$.post(
                    URL+'/reporteDatosActividad',
                    $(this).serialize(),
                    function(data){
                        $('#contenido_reporte2').html(data);
                        $('#Tabla_Reporte2').DataTable({
					        dom: 'Bfrtip',
					        buttons: [
					            'copyHtml5',
					            'excelHtml5',
					            'csvHtml5',
					            'pdfHtml5'
					        ]
					    });
                    }
                );

        e.preventDefault();
	});



});