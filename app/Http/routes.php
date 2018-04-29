<?php
/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

//Autenticación
Route::auth();
Route::group(['prefix'=>'auth', 'namespace'=>'Auth'], function() {
	Route::resource('usuarios', 'AuthController');
	Route::resource('roles', 'RoleController');
	Route::resource('permisos', 'PermissionController');
});
Route::get('password/email/{id}', 'Auth\PasswordController@sendEmail');
Route::get('password/reset/{id}', 'Auth\PasswordController@showResetForm');

Route::group(['prefix'=>'app', 'namespace'=>'App'], function() {
	Route::resource('menu', 'MenuController', ['parameters'=>['menu'=>'MENU_ID']]);
	Route::post('menu/reorder', 'MenuController@reorder')->name('app.menu.reorder');
	Route::get('parameters', 'ParametersController@index')->name('app.parameters');
	Route::get('upload', 'UploadDataController@index')->name('app.upload.index');
	Route::post('upload', 'UploadDataController@upload')->name('app.upload');
});

Route::group(['middleware'=>'auth'], function() {
	Route::get('/', function(){
		if(Entrust::hasRole(['owner','admin','gesthum']))
			return view('dashboard/charts');
		return view('layouts.menu');
	});
	Route::get('getArrModel', 'Controller@ajax');
});

Route::group(['prefix'=>'reportes', 'namespace'=>'Reportes', 'middleware'=>'auth'], function() {
	Route::get('/', 'ReporteController@index');
	Route::get('/viewForm', 'ReporteController@viewForm');
	
	Route::post('ContratosActivos', 'RptContratosController@contratosActivos');
	Route::post('ContratosHistorico', 'RptContratosController@historicoContratos');
	Route::post('ContratosIngresosPorFecha', 'RptContratosController@ingresosPorFecha');
	Route::post('ContratosRetirosPorFecha', 'RptContratosController@retirosPorFecha');
	Route::post('ContratosHistoriaPorCedula', 'RptContratosController@historiaPorCedula');
	Route::post('ContratosProximosTemporalidad', 'RptContratosController@proximosTemporalidad');
	Route::post('ContratosProximosFinalizar', 'RptContratosController@proximosFinalizar');
	Route::post('ContratosHeadcountRm', 'RptContratosController@headcountRm');
	Route::post('ContratosHistoricoRm', 'RptContratosController@historicoRm');
	Route::post('ContratosNovedadesRm', 'RptContratosController@novedadesRm');
	Route::post('ContratosActivosPorPeriodo', 'RptContratosController@activosPorPeriodo');
	Route::post('ContratosAtributosPorEmpleado', 'RptContratosController@atributosPorEmpleado');
	Route::post('ContratosActivosPlantillaNovedades', 'RptContratosController@activosPlantillaNovedades');

	Route::post('ticketsPorFecha', 'RptTicketsController@ticketsPorFecha');

	Route::post('ProspectosSinContrato', 'RptProspectosController@hojasDeVida');
	Route::post('ProspectosDescartados', 'RptProspectosController@hojasDeVidaDescartadas');
	Route::post('ProspectosCumpleanios', 'RptProspectosController@cumpleanios');

	Route::post('PlantasAutorizadas', 'RptPlantasController@plantasAutorizadas');
	Route::post('PlantasMovimientos', 'RptPlantasController@movimientosPlantas');
	Route::post('PlantasVrsActivos', 'RptPlantasController@plantasVrsActivos');

	Route::post('AusentismosListadoAusentismos', 'RptAusentismosController@listadoAusentismos');
	Route::post('AusentismosListadoAusentismosProrrogas', 'RptAusentismosController@listadoAusentismosProrrogas');

	Route::post('AsistenciasEmpleados', 'RptAsistenciasController@listadoAsistencias');
});

Route::group(['prefix'=>'cnfg-contratos', 'namespace'=>'CnfgContratos'], function() {
	Route::resource('cnos', 'CnosController', ['parameters'=>['cnos'=>'CNOS_ID']]);
	Route::resource('cargos', 'CargoController', ['parameters'=>['cargos'=>'CARG_ID']]);
	Route::resource('tiposcontratos', 'TipoContratoController', ['parameters'=>['tiposcontratos'=>'TICO_ID']]);
	Route::resource('temporales', 'TemporalController');
	Route::resource('clasescontratos', 'ClaseContratoController');
	Route::resource('estadoscontratos', 'EstadoContratoController');
	Route::resource('motivosretiros', 'MotivoRetiroController');
	Route::resource('negocios', 'NegocioController');
	Route::resource('atributos', 'AtributoController');
	Route::resource('empleadoatributo', 'EmpleadoAtributoController');
});

Route::group(['prefix'=>'cnfg-organizacionales', 'namespace'=>'CnfgOrganizacionales'], function() {
	Route::resource('empleadores', 'EmpleadorController');
	Route::get('empleadores/{EMPL_ID}/getSignature', 'EmpleadorController@getSignature');
	Route::get('empleadores/{EMPL_ID}/getLogo', 'EmpleadorController@getLogo');

	Route::resource('gerencias', 'GerenciaController');
	Route::resource('procesos', 'ProcesoController');
	Route::resource('centroscostos', 'CentroCostoController');
	Route::resource('tiposempleadores', 'TipoEmpleadorController');
	Route::resource('riesgos', 'RiesgoController');
	Route::resource('grupos', 'GrupoController');
	Route::resource('turnos', 'TurnoController');
	Route::resource('plantaslaborales', 'PlantaLaboralController');
	Route::resource('tipoentidades', 'TipoEntidadController');
	Route::resource('entidades', 'EntidadController');
	Route::resource('movimientosplantas', 'MovimientoPlantaController');
	Route::resource('periodos', 'PeriodoController');
	Route::resource('periodosnominas', 'PeriodoNominaController');
});

Route::group(['prefix'=>'cnfg-geograficos', 'namespace'=>'CnfgGeograficos'], function() {
	Route::resource('paises', 'PaisController', ['parameters'=>['pais'=>'PAIS_ID']]);
	Route::get('getPaises', 'PaisController@getData');
	Route::resource('departamentos', 'DepartamentoController', ['parameters'=>['departamento'=>'DEPA_ID']]);
	Route::get('getDepartamentos', 'DepartamentoController@getData');
	Route::resource('ciudades', 'CiudadController', ['parameters'=>['ciudad'=>'CIUD_ID']]);
	Route::get('getCiudades', 'CiudadController@getData');
});

Route::group(['prefix'=>'gestion-humana', 'namespace'=>'GestionHumana'], function() {
	Route::resource('prospectos', 'ProspectoController', ['parameters'=>['prospectos'=>'PROS_ID']]);
	Route::get('getProspectos', 'ProspectoController@getData');
	Route::get('getArrProspectosRetirados', 'ProspectoController@getArrProspectosRetirados');
	Route::get('getArrProspectos', 'ProspectoController@getArrProspectos');

	Route::resource('contratos', 'ContratoController', ['parameters'=>['contratos'=>'CONT_ID']]);

	Route::resource('movimientosempleados', 'MovimientoEmpleadoController', ['parameters'=>['movimientosempleados'=>'MOEM_ID']]);
	Route::resource('asistenciasempleados', 'AsistenciaEmpleadoController', ['parameters'=>['asistenciasempleados'=>'ASEM_ID']]);

	Route::get('asistencia','AsistenciaEmpleadoController@index');
	Route::post('asistencia/getListado', 'AsistenciaEmpleadoController@getData');
	Route::post('asistencia/save', 'AsistenciaEmpleadoController@store');

	Route::get('contratos/certificados', 'CertificadoContratoController@index')->name('cnfg-contratos.certificados.index');
	Route::get('contratos/{contrato}/certificado', 'CertificadoContratoController@buildPdf')->name('cnfg-contratos.certificados.build');
	Route::get('getContratos', 'ContratoController@getData');

	Route::get('getContratosEmpleador', 'ContratoController@getContratosEmpleador');
	Route::get('getContratosParticipacion', 'ContratoController@getContratosParticipacion');
	Route::get('/retirarContrato','ContratoController@retirarContrato')->name('gestion-humana.contratos.retirarContrato');
	Route::post('/cambiarEstado','ContratoController@cambiarEstado')->name('gestion-humana.contratos.cambiarEstado');
	Route::get('/buscaGerencia','ContratoController@buscaGerencia');
	Route::get('/buscaCentroCosto','ContratoController@buscaCentroCosto');
	Route::get('/buscaGrupo','ContratoController@buscaGrupo');
	Route::get('/buscaTurno','ContratoController@buscaTurno');
	Route::get('/buscaNegocio','ContratoController@buscaNegocio');

	Route::group(['prefix'=>'helpers', 'namespace'=>'Helpers'], function() {
		Route::get('validadorTNL', 'TnlController@index')->name('tnl.index');
		Route::get('validadorTNL/upload', 'TnlController@create')->name('tnl.create');
		Route::post('validadorTNL/upload', 'TnlController@store')->name('tnl.store');
		Route::post('validadorTNL/delete', 'TnlController@delete')->name('tnl.delete');
	});
});

Route::group(['prefix'=>'cnfg-tickets', 'namespace'=>'CnfgTickets'], function() {
	Route::resource('prioridades', 'PrioridadController');
	Route::resource('estadostickets', 'EstadoTicketController');
	Route::resource('categorias', 'CategoriaController');
	Route::resource('tiposincidentes', 'TipoIncidenteController');
	Route::resource('estadosaprobaciones', 'EstadoAprobacionController');
	Route::resource('sanciones', 'SancionController');
	Route::resource('tickets', 'TicketController');
	Route::get('getTickets', 'TicketController@getData');
	Route::get('tickets/autorizar/{TICK_ID}', 'TicketController@autorizarTicket');
	Route::post('tickets/rechazar/{TICK_ID}', 'TicketController@rechazarTicket');
	Route::post('tickets/cerrar/{TICK_ID}', 'TicketController@cerrarTicket');
	Route::get('getTicketsPorEstado', 'TicketController@getTicketsPorEstado');
	Route::get('getTicketsAbiertosPorEmpresa', 'TicketController@getTicketsAbiertosPorEmpresa');

	Route::get('/buscaGrupo','TicketController@buscaGrupo');
	Route::get('/buscaTurno','TicketController@buscaTurno');
});

Route::group(['prefix'=>'cnfg-ausentismos', 'namespace'=>'CnfgAusentismos'], function() {
	Route::resource('diagnosticos', 'DiagnosticoController');
	Route::get('getDiagnostico', 'DiagnosticoController@getData');
	Route::resource('conceptoausencias', 'ConceptoAusenciaController');
	Route::resource('tipoausentismos', 'TipoAusentismoController');
	Route::resource('ausentismos', 'AusentismoController');
	Route::get('/buscaContrato','AusentismoController@buscaContrato');
	Route::get('/buscaEntRes','AusentismoController@buscaEntRes');
	Route::get('/buscaDx', 'DiagnosticoController@buscaDx');
	Route::get('/autocomplete',array('as'=>'autocomplete','uses'=>'DiagnosticoController@autocomplete'));
	Route::resource('prorrogaausentismos', 'ProrrogaAusentismoController');
	Route::get('/buscaAuse/{id?}', 'ProrrogaAusentismoController@buscaAuse');
});

Route::group(['prefix'=>'cnfg-casosmedicos', 'namespace'=>'CnfgCasosMedicos'], function() {
	Route::resource('diagnosticosgenerales', 'DiagnosticoGeneralController');
	Route::resource('estadosrestriccion', 'EstadoRestriccionController');
	Route::resource('casosmedicos', 'CasoMedicoController');
	Route::resource('novedadesmedicas', 'NovedadMedicaController');
});


