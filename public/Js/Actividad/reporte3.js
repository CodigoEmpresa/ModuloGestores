
$(function(){
	 $('#actividadesTabla').DataTable({
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
        var formData = new FormData($("#form_reporte3")[0]);       
        $("#resultado").hide('slow');
            	$("#loading").show('slow');    
      
        $.ajax({
          url: 'DatosActividadReporte3',  
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
            	var t = $('#actividadesTabla').DataTable();
            	t.row.add( ['1', '1','1', '1', '1','1', '1', '1','1', '1', '1','1', '1', '1','1', '1'] ).clear().draw( false );            	        	
        		$.each(xhr, function(i, e){
            		IestadoP = 0;
            		estadoP = '';
            		IestadoP = e['Estado'];
            		if(IestadoP == 1){estadoP = 'Espera';}
            		else if(IestadoP == 2){estadoP = 'Aprobado';}
            		else if(IestadoP == 3){estadoP = 'Cancelado';}

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

	    			t.row.add( [
	    				e['Id_Actividad_Gestor'],
	    				e['Fecha_Ejecucion'],
	    				e['Hora_Incial'],
	    				e.localidad['Nombre_Localidad'],
	    				NombreParque,
	    				e['Hora_Implementacion'],
	    				e['Hora_Final'],
	    				NombreEje,
	    				NombreTematica,
	    				NombreActividad,
	    				NombreKit,
	    				CantidadKit,
	    				e['Caracteristica_Poblacion'],
	    				e['Numero_Asistente'],
	    				estadoP,
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
		$('#form_reporte3 .form-group').removeClass('has-error');

		$.each(data, function(i, e){
			$("#"+i).closest('.form-group').addClass('has-error');
      	});
	}

	$.datepicker.setDefaults($.datepicker.regional["es"]);
	
	$('#FechaInicioDate').datepicker({format: 'yyyy-mm-dd', autoclose: true,});
	$('#FechaFinDate').datepicker({format: 'yyyy-mm-dd', autoclose: true,});
	
});