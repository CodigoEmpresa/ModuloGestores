
$(function(){
	 $('#ejecucionesTabla').DataTable({
        retrieve: true,
        buttons: [
            'copy', 'csv', 'excel'
        ],
        dom: 'Bfrtip',
        select: true,
        "responsive": true,
        "ordering": true,
        "info": true,
        "pageLength": 20,
        "language": {
            url: 'public/DataTables/Spanish.json',
            searchPlaceholder: "Buscar"
        }
    });

	$("#Generar").on('click', function(){

		var token = $("#token").val();
        var formData = new FormData($("#form_reporte5")[0]);       
        $("#resultado").hide('slow');
    	$("#loading").show('slow');    
      
        $.ajax({
          url: 'DatosReporte5',  
          type: 'POST',
          data: formData,
          contentType: false,
          processData: false,
          dataType: "json",
          success: function (xhr) {
            if(xhr.status == 'error'){
                validador_errores(xhr.errors);
                $("#loading").hide('slow');  
                $("#resultado").show('slow');
            }
            else 
            {
            	var t = $('#ejecucionesTabla').DataTable();
            	t.row.add( ['1', '1','1', '1', '1','1', '1', '1','1', '1','1', '1', '1','1', '1', '1'] ).clear().draw( false );            	        	
        		$.each(xhr, function(i, e){
            		IestadoP = 0;
            		estadoP = '';
            		IestadoP = e['Estado'];
            		if(IestadoP == 1){estadoP = 'ESPERA';}
            		else if(IestadoP == 2){estadoP = 'APROBADO';}
            		else if(IestadoP == 3){estadoP = 'CANCELADO';}


                    IestadoE = 0;
                    estadoE = '';
                    IestadoE = e['Estado_Ejecucion'];
                    if(IestadoE == 1){estadoE = 'NO HAY INFORMACIÓN ';}
                    else if(IestadoE == 2){estadoE = 'SI HAY INFORMACIÓN';}
                    else if(IestadoE == 3){estadoE = 'APROBADO';}
                    else if(IestadoE == 4){estadoE = 'CANCELADO';}

            		NombreKit = 0;
            		NumKit = 0;

            		if(e.gestor_actividad_ejetematica.length > 0){
	            		if(e.gestor_actividad_ejetematica[0]['Kit'] == 1){
	            			NombreKit = 'SI';
	            		}else if(e.gestor_actividad_ejetematica[0]['Kit'] == 2){
	            			NombreKit = 'NO';
	            		}
	            		NombreEje = e.gestor_actividad_ejetematica[0].eje['Nombre_Eje'];
	    				NombreTematica = e.gestor_actividad_ejetematica[0].tematica['Nombre_Tematica'];
	    				NombreActividad = e.gestor_actividad_ejetematica[0].actividad['Nombre_Actividad'];
	    				CantidadKit = e.gestor_actividad_ejetematica[0]['Cantidad_Kit'];
            		}else{
	            		NombreKit = 'NO EXISTE INFORMACION';
	            		NombreEje = 'NO EXISTE INFORMACION';
	    				NombreTematica = 'NO EXISTE INFORMACION';
	    				NombreActividad = 'NO EXISTE INFORMACION';
	    				CantidadKit = 0;
	            	}

            		if(e.parque != null){
            			NombreParque = e.parque['Nombre'];
            		}else{
            			NombreParque = e['Otro'];            			
            		}

                    if(e.calificaciom_servicio.length > 0){
                        Puntualidad = e.calificaciom_servicio[0]['Id_Puntualidad'];
                        Divulgacion  = e.calificaciom_servicio[0]['Id_Divulgacion'];
                        Montaje = e.calificaciom_servicio[0]['Id_Montaje'];
                        NombreCalificador = e.calificaciom_servicio[0]['Nombre_Representante'];
                        TelefonoCalificador = e.calificaciom_servicio[0]['Telefono'];

                    }else{
                        Puntualidad = 'NO EXISTE INFORMACION';
                        Divulgacion  = 'NO EXISTE INFORMACION';
                        Montaje = 'NO EXISTE INFORMACION';
                        NombreCalificador = 'NO EXISTE INFORMACION';
                        TelefonoCalificador = 'NO EXISTE INFORMACION';
                    }

	    			t.row.add( [
	    				e['Id_Actividad_Gestor'],
	    				e['Fecha_Ejecucion'],
	    				e.localidad['Nombre_Localidad'],
	    				NombreParque,
	    				NombreEje,
	    				NombreTematica,
	    				NombreActividad,
	    				NombreKit,
	    				e['Caracteristica_Poblacion'],
	    				e['Numero_Asistente'],
                        estadoE,
                        Puntualidad,
                        Divulgacion,
                        Montaje,
                        NombreCalificador,
                        TelefonoCalificador,
			        ] ).draw( false );
	    		});
				setTimeout(function(){ 
					$("#loading").hide('slow');  
					$("#resultado").show('slow');            		
            	}, 2000);


            }
          }
        });
	});

	function validador_errores (data){
		$('#form_reporte5 .form-group').removeClass('has-error');

		$.each(data, function(i, e){
			$("#"+i).closest('.form-group').addClass('has-error');
      	});
	}

	$.datepicker.setDefaults($.datepicker.regional["es"]);
	
	$('#FechaInicioDate').datepicker({format: 'yyyy-mm-dd', autoclose: true,});
	$('#FechaFinDate').datepicker({format: 'yyyy-mm-dd', autoclose: true,});
	
});