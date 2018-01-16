<?php
session_start();
/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
Route::any('/', 'Actividadcontroller@show');
Route::any('uno', function () {                
    return 'welcome';
});


Route::group(['middleware' => ['web']], function () {
	Route::get('/personas', '\Idrd\Usuarios\Controllers\PersonaController@index');
	Route::get('/personas/service/obtener/{id}', '\Idrd\Usuarios\Controllers\PersonaController@obtener');
	Route::get('/personas/service/buscar/{key}', '\Idrd\Usuarios\Controllers\PersonaController@buscar');
	Route::get('/personas/service/ciudad/{id_pais}', '\Idrd\Usuarios\Controllers\LocalizacionController@buscarCiudades');
	Route::post('/personas/service/procesar/', '\Idrd\Usuarios\Controllers\PersonaController@procesar');

	Route::get('/asignarLocalidad', 'ConfiguracionActividadController@asignarLocalidad');
	Route::get('/CrearActividad', 'Actividadcontroller@index');
	Route::get('/Modificar', 'Actividadcontroller@index');
	Route::get('/MisProgramaciones', 'Actividadcontroller@MiActividad');
	Route::get('/MisActividades', 'mis_actividades_promotores@Mis_Actividad');
	Route::get('/ActividadesAprobar', 'aprobacion_actividades@Mis_Actividad');
	Route::get('/Reporte', 'ReporteController@reporte');
	Route::get('/Reporte2', 'ReporteController@reporte2');
	Route::get('/Reporte3', 'ReporteController@reporte3');
	Route::get('/Reporte4', 'ReporteController@reporte4');
	Route::get('/Reporte5', 'ReporteController@reporte5');
	Route::post('DatosActividadReporte3/', 'ReporteController@DatosActividadReporte3');
	Route::post('DatosReporte5/', 'ReporteController@DatosReporte5');
	
	Route::get('/Cerrar', 'Actividadcontroller@Cerrar');

	Route::post('/Reporte/reporteTipoPoblacional/', 'ReporteController@reportePoblacional');
	Route::post('/Reporte/reporteDatosActividad/', 'ReporteController@reporteDatosActividades');

	Route::get('/actividad/service/obtener/{id_actividad}', 'Actividadcontroller@obtenerActividad');
	Route::post('/actividad/service/crearActividad/', 'ConfiguracionActividadController@procesarValidacion');
	Route::get('/actividad/service/tematica/{id_eje}', 'ConfiguracionActividadController@buscarTematicas');
	Route::get('/actividad/service/actividad/{id_tematica}', 'ConfiguracionActividadController@buscarActividades');
	Route::get('/actividad/service/persona_tipo/{id_tipo}', '\Idrd\Usuarios\Controllers\PersonaController@buscarPersonaTipo');
	Route::get('/actividad/MisProgramaciones', 'Actividadcontroller@MiActividad2');
	Route::get('/actividad/service/Eje/{id_eje}', 'ConfiguracionActividadController@buscarEje');
	Route::get('/actividad/service/Tematica/{id_tematica}', 'ConfiguracionActividadController@buscarTematica');
	Route::get('/actividad/service/Actividad/{id_actividad}', 'ConfiguracionActividadController@buscarActividad');
	Route::post('/PersonaLocalidad/service/validacionPersonaLocalidad/', 'ConfiguracionActividadController@procesarValidacionPersonaLocalidad');
	Route::post('/PersonaLocalidad/service/eliminaPersonaLocalidad/', 'ConfiguracionActividadController@eliminaPersonaLocalidad');
	Route::post('/PersonaLocalidad/service/verPersonaLocalidad/', 'ConfiguracionActividadController@verPersonaLocalidad');
	Route::post('/actividad/service/ModificarActividad/', 'ConfiguracionActividadController@procesarModificacionValidacion');

	Route::post('/gestores/service/misActividadesGestor/', 'mis_actividades_promotores@procesarValidacionGestor');
	Route::get('/gestores/service/obtener/{id_actividad}', 'mis_actividades_promotores@obtenerActividad');
	Route::get('/gestores/service/obtenerEjecucion/{id_actividad}', 'mis_actividades_promotores@obtenerEjecucion');
	Route::post('/gestores/service/datos_actividades/', 'mis_actividades_promotores@procesarValidacionDatosEjecucion');
	Route::post('/gestores/service/datos_novedades/', 'mis_actividades_promotores@procesarValidacionDatosNovedades');
	Route::post('/gestores/service/registro_ejecucion/', 'mis_actividades_promotores@procesarValidacionRegistroEjecucion');
	Route::post('/gestores/service/modifica_ejecucion/', 'mis_actividades_promotores@procesarValidacionModificacionEjecucion');
	Route::get('/gestores/service/cancelarE/{id_actividad}/{Observacion_Cancela}', 'mis_actividades_promotores@cancelarEjecucion');

	Route::post('/aprobar/service/misActividadesGestor/', 'aprobacion_actividades@procesarValidacionGestor');
	Route::get('/aprobar/service/obtener/{id_actividad}', 'aprobacion_actividades@obtenerEjecucion');
	Route::post('/aprobar/service/ModificarActividad/', 'aprobacion_actividades@procesarModificacionValidacion');
	Route::get('/aprobar/service/activar/{id_actividad}', 'aprobacion_actividades@activarProgramacion');
	Route::get('/aprobar/service/aprobarEjecucion/{id_actividad}', 'aprobacion_actividades@aprobarEjecucion');
	Route::get('/aprobar/service/cancelarEjecucion/{id_actividad}', 'aprobacion_actividades@cancelarEjecucion');
	Route::get('/aprobar/service/cancelar/{id_actividad}/{Observacion_Cancela}', 'aprobacion_actividades@cancelarProgramacion');

	Route::get('/asignarTipoPersona', 'ConfiguracionActividadController@asignarTipoPersona');
	Route::get('/tipo_modulo', 'ConfiguracionActividadController@tipoModulo');
	Route::post('ProcesoTipoPersona', 'ConfiguracionActividadController@AdicionTipoPersona');
	Route::get('/asignarActividades', 'ConfiguracionActividadController@asignarActividades');
	Route::get('/actividadesModulo', 'ConfiguracionActividadController@moduloActividades');
	Route::get('/actividadesPersona/{id}', 'ConfiguracionActividadController@personaActividades');
	Route::post('PersonasActividadesProceso', 'ConfiguracionActividadController@PersonasActividadesProceso');

	Route::get('/actividad/service/getParques/{id_localidad}', 'Actividadcontroller@GetParques');
	Route::get('/aprobar/service/getParques/{id_localidad}', 'Actividadcontroller@GetParques');
    
});
