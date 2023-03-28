<?php
use Illuminate\Support\Facades\Route;
use App\Mail\facturasMail;
use Illuminate\Support\Facades\Mail;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
/*
|--------------------------------------------------------------------------
| Login Usuario
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();


/*
|--------------------------------------------------------------------------
| Main de la aplicacion
|--------------------------------------------------------------------------
*/
Route::get('/main', 'HomeController@index')->name('main');


// Route::get('/main/facturacion/{email}', function($email){
// 	$correo = new facturasMail;
// 	Mail::to($email)->send($correo);

// 	return "mensaje enviado";
// });

/*
|--------------------------------------------------------------------------
| Registro y Control
|--------------------------------------------------------------------------
*/
/* Anular Movimiento de Estado de Cuenta*/
Route::get('/main/ryc/seleccionaredo', 'Tramites\EstadosCuentasController@seleccionaredo')->name('seleccionaredo');
Route::post('/main/ryc/anularmovedo', 'Tramites\EstadosCuentasController@anularmovedo')->name('anularmovedo');
Route::get('/main/ryc/registro', 'Registro\RegistroController@index')->name('registro');



Route::get('/main/ryc/generardeuda', 'RegistroyControl\RucController@deudamorosa')->name('generardeuda');
Route::post('/main/ryc/procesardeuda', 'RegistroyControl\RucController@procesardeuda')->name('procesardeuda');
Route::get('/main/anularpago/{id}', 'RegistroyControl\PagosController@anularpago')->name('anularpago');
Route::get('/main/ryc/{sp?}', 'RegistroyControl\RucController@index')->name('ruc');

/* Edit */
Route::get('/main/ryc/editsp/{idsp}', 'RegistroyControl\EditarController@contribuyente')->name('editsp');
Route::post('/main/ryc/updatesp', 'RegistroyControl\EditarController@update')->name('updatesp');
Route::get('/main/ryc/edittrb/{idtributo}', 'RegistroyControl\EditarController@tributo')->name('edittrb');
Route::post('/main/ryc/updatetrb', 'RegistroyControl\EditarController@updatetrb')->name('updatetrb');

/*
|--------------------------------------------------------------------------
| Fin Registro y Control
|--------------------------------------------------------------------------
*/


/*
|--------------------------------------------------------------------------
| Menu Tramites
|--------------------------------------------------------------------------
*/
/* Solicitud de tramites*/
Route::any('/main/solicitudtramite/{idhi?}', 'Tramites\TramitesController@index')->name('solicitudtramite');
/* Estado de Cuenta */
Route::get('/main/estadodecuenta/{idtributo?}/{imprimir?}', 'Tramites\EstadosCuentasController@index')->name('estadodecuenta');
Route::any('/main/imprimirfactura/{id}', 'Reportes\FacturasController@imprimirfactura')->name('imprimirfactura');
Route::any('/main/imprimirhfactura/{id}/{idtributo}', 'Reportes\FacturasController@imprimirhfactura')->name('imprimirhfactura');
Route::any('/main/imprimirfacturapub/{id}', 'Reportes\FacturasController@imprimirfacturapub')->name('imprimirfacturapub');
/* Aprobacion de Tramites */
Route::get('/main/aprobaciontramites', 'Tramites\TramitesController@listado')->name('aprobaciontramites');

/*
|--------------------------------------------------------------------------
| Proceso Registro de Tramites
|--------------------------------------------------------------------------
*/
/* Tramites Paso 
|  Datos del Solicitante
*/
Route::post('/main/tramites/solicitante', 'Tramites\TramitesController@solicitante')->name('tramitesolicitante');
/* 
|  Tramites Paso 
|  Requisitos
*/
Route::post('/main/tramites/requisitos', 'Tramites\TramitesController@tramiterequisitos')->name('tramiterequisitos');
Route::post('/main/tramites/regrequisitos', 'Tramites\TramitesController@regrequisitos')->name('regrequisitos');
/*  
|  Fin Valida tasas
*/
/*
|  Tramites Paso 
|  Sujeto Pasivo
*/

Route::any('/main/tramite/sujetopasivo', 'Tramites\TramitesController@datosp')->name('sujetopasivo');
Route::any('/main/tramite/sp', 'Tramites\TramitesController@regsp')->name('regsp');
/*
|  Fin Sujeto Pasivo
*/
/* 
|  Tramites Paso 
|  Ubicacion Geografica
*/
Route::any('/main/tramite/ubg', 'Tramites\TramitesController@ubg')->name('ubg');
Route::any('/main/tramite/regubg', 'Tramites\TramitesController@regubg')->name('regubg');
/* 
|  Fin Ubicacion Geografica
*/
/* 
|  Tramites Paso 
|  Definir Accion Tributo
*/
Route::post('/main/tramite/tributo', 'Tramites\TramitesController@tributo')->name('tributo');
/*
| Fin Definir Accion Tributo
*/
/* 
|  Tramites Paso 
|  Propiedad Inmobiliaria
*/
Route::any('/main/tramite/datosinm', 'Tramites\TramitesController@datosinm')->name('datosinm');
Route::any('/main/tramite/reginm', 'Tramites\TramitesController@reginm')->name('reginm');
/*  
|  Fin Propiedad Inmobiliaria
*/
/* 
|  Tramites Paso 
|  Publicidad
*/
Route::any('/main/tramite/pub', 'Tramites\TramitesController@pub')->name('pub');
Route::any('/main/tramite/addclapub', 'Tramites\TramitesController@addclapub')->name('addclapub');
Route::any('/main/tramite/datospub', 'Tramites\TramitesController@datospub')->name('datospub');
Route::any('/main/tramite/regpub', 'Tramites\TramitesController@regpub')->name('regpub');
/* 
|  Fin Propiedad Inmobiliaria
*/
/* 
|  Tramites Paso 
|  LAE
*/
Route::any('/main/tramite/reglae', 'Tramites\TramitesController@reglae')->name('reglae');
Route::any('/main/tramite/lae', 'Tramites\TramitesController@lae')->name('lae');
Route::any('/main/tramite/addclalae', 'Tramites\TramitesController@addclalae')->name('addclalae');
/* 
|  Fin LAE
*/
/* 
|  Tramites Paso 
|  Cobro de tasas
*/
Route::any('/main/tramite/tramitetasas', 'Tramites\TramitesController@tramitetasas')->name('tramitetasas');
Route::any('/main/tramite/regubg', 'Tramites\TramitesController@regubg')->name('regubg');
/* 
|  Fin Cobro de Tasas
*/
Route::any('/main/tramite/resumen','Tramites\TramitesController@resumen')->name('resumen');
Route::get('/main/tramite/registrotramite','Tramites\TramitesController@registrotramite')->name('registrotramite');
/* 
| Busquedas ajax 
*/
Route::get('/main/buscarvia','Configuracion\SectoresController@buscarvia');
Route::get('/main/buscarbarrios','Configuracion\SectoresController@buscarbarrios');
Route::get('/main/buscartipoinm','Tributos\TipoInmueblesController@buscartipoinm');
Route::get('/main/buscarmercadostarifa','Registro\MercadosController@buscarmercadostarifa');
Route::get('/main/buscarcategoriaambiente','Registro\AmbienteController@buscarcategoriaambiente');
/* 
| Fin Busquedas ajax 
*/
/* Registro Express*/
Route::post('/main/registro/guardarbillar', 'Registro\BillaresController@store')->name('guardarbillar');
Route::post('/main/registro/guardards', 'Registro\DesechosSolidosController@store')->name('guardards');
Route::post('/main/registro/guardarhotel', 'Registro\HotelesController@store')->name('guardarhotel');
Route::get('/main/registro/registrar', 'Registro\RegistroController@registrar')->name('registrar');
Route::post('/main/registro/busquedasp', 'Registro\RegistroController@busquedasp')->name('busquedasp');
Route::get('/main/registro/billares/{id}', 'Registro\BillaresController@index')->name('billares');
Route::get('/main/registro/hoteles/{id}', 'Registro\HotelesController@index')->name('hoteles');
Route::get('/main/registro/ds/{id}', 'Registro\DesechosSolidosController@index')->name('ds');
# Ambiente
Route::get('/main/registro/ambiente/{id}', 'Registro\AmbienteController@index')->name('ambiente');
Route::post('/main/registro/guardarambiente', 'Registro\AmbienteController@store')->name('guardarambiente');
# Mercado
Route::get('/main/registro/mercados/{id}', 'Registro\MercadosController@index')->name('mercados');
Route::post('/main/registro/busquedaspmercados', 'Registro\MercadosController@busquedaspmercados')->name('busquedaspmercados');
Route::get('/main/registro/registrarmercados', 'Registro\MercadosController@registrar')->name('registrarmercados');
Route::post('/main/registro/guardarmercados', 'Registro\MercadosController@store')->name('guardarmercados');



/*
|--------------------------------------------------------------------------
| Fin Menu Tramites
|--------------------------------------------------------------------------
*/

/*
|--------------------------------------------------------------------------
| Menu Taquilla
|--------------------------------------------------------------------------
*/
/* Mi Taquilla*/
Route::get('/main/mitaquilla/{fecha?}/{imprimir?}', 'Taquilla\TaquillaController@mitaquilla')->name('mitaquilla');
//Route::get('/main/mitaquilla', 'Taquilla\TaquillaController@mitaquilla')->name('mitaquilla');
/* Procesar Pagos*/
Route::post('/main/procesarpago', 'Taquilla\TaquillaController@procesarpago')->name('procesarpago');
/* Comprobantes de Pagos*/
Route::any('/main/comprobantes', 'Taquilla\TaquillaController@comprobantes')->name('comprobantes');
Route::get('/main/comprobante/{id}', 'Taquilla\TaquillaController@comprobante')->name('comprobante');

Route::get('/main/pagosdiversos/{id?}', 'Taquilla\PagosDiversosController@index')->name('pagosdiversos');
Route::get('/main/selecciontasa', 'Taquilla\PagosDiversosController@selecciontasa')->name('selecciontasa');
Route::post('/main/pagotasa', 'Taquilla\PagosDiversosController@pagotasa')->name('pagotasa');
Route::post('/main/guardartasas', 'Taquilla\PagosDiversosController@guardartasa')->name('guardartasas');
Route::any('/main/tasasujetopasivo', 'Taquilla\PagosDiversosController@tasasujetopasivo')->name('tasasujetopasivo');

/*
|--------------------------------------------------------------------------
| Fin Menu Taquilla
|--------------------------------------------------------------------------
*/
/*
|--------------------------------------------------------------------------
| Menu Reportes
|--------------------------------------------------------------------------
*/

/* Deuda Morosa*/
Route::get('/main/deudamorosa', 'Reportes\ReportesController@deudamorosa')->name('deudamorosa');
/* Deuda Recaudacion*/
Route::get('/main/recaudacion', 'Reportes\ReportesController@recaudacion')->name('recaudacion');
/* Deuda Cuentas*/
Route::get('/main/cuentas/{desde?}/{hasta?}/{imprimir?}', 'Reportes\ReportesController@cuentas')->name('cuentas');
/*Cierre de Pagos */ 
Route::get('/main/pagos/{fecha?}/{imprimir?}', 'Reportes\ReportesController@pagos')->name('pagos');
/* Reporte en excel */
Route::get('/main/detalledeudamorosa', 'Reportes\ReportesController@detalledeudamorosa')->name('detalledeudamorosa');

/*
|--------------------------------------------------------------------------
| Fin Memu Reportes
|--------------------------------------------------------------------------
*/
/*
|--------------------------------------------------------------------------
| Facturacion
|--------------------------------------------------------------------------
*/
/*| Factura de Recoleccion especial de Desechos Solidos|*/
Route::post('/main/facturacion/asignarvalorfiscal/', 'Reportes\FacturasController@asignarvalorfiscal')->name('asignarvalorfiscal');
Route::get('/main/facturacion/valorfiscal/', 'Reportes\FacturasController@valorfiscal')->name('valorfiscal');
Route::get('/main/facturacion/facturacionespecial/{idtributo?}', 'RegistroyControl\FacturacionEspecial@index')->name('facturacionespecial');
Route::post('/main/facturacion/facturaespecial', 'Reportes\FacturasController@generarfacturaespecial')->name('facturaespecial');
Route::any('/main/facturacion/imprimirfacturaespecial/{id}', 'Reportes\FacturasController@imprimirfacturaespecial')->name('imprimirfacturaespecial');


/*| Facturar Desechos Solidos |*/
Route::get('/main/facturacion/facturar', 'Reportes\FacturasController@index')->name('facturar');

Route::any('/main/facturacion/sectorfacturas/{idperiodomensual}/{idtipofactura}', 'Reportes\FacturasController@sectorfacturas')->name('sectorfacturas');

Route::get('/main/facturacion/barriosfacturas/{idperiodomensual}/{idtipofactura}/{idsector}', 'Reportes\FacturasController@barriosfacturas')->name('barriosfacturas');


Route::post('/main/facturacion/generarfacturas', 'Reportes\FacturasController@generar')->name('generarfacturas');
/*| Facturas por Lote |*/
Route::any('/main/facturacion/facturas/{idperiodomensual}/{idtipofactura}/{idsector}/{idbarrio}', 'Reportes\FacturasController@facturas')->name('facturas');
Route::get('/main/facturacion/facturaredu', 'Reportes\FacturasController@index')->name('facturacionedu');
/*
|--------------------------------------------------------------------------
| Fin Facturacion
|--------------------------------------------------------------------------
*/

/*
|--------------------------------------------------------------------------
| Menu configuracion
|--------------------------------------------------------------------------
*/

Route::get('main/clasificadores',  [
	'middleware' => 'auth',
	'uses'		 => 'Configuracion\RequisitosController@index',
	'as' 		 => 'clasificadores'
]);

/* Requisitos de los tramites */
Route::get('main/requisitos',  [
	'middleware' => 'auth',
	'uses'		 => 'Configuracion\RequisitosController@index',
	'as' 		 => 'requisitos'
]);


Route::post('main/guardarreq',  [
	'middleware' => 'auth',
	'uses'		 => 'Configuracion\RequisitosController@guardarreq',
	'as' 		 => 'guardarreq'
]);

/* Requisitos de las tasas */
Route::get('main/tasas',  [
	'middleware' => 'auth',
	'uses'		 => 'Configuracion\TasasController@index',
	'as' 		 => 'tasas'
]);
Route::post('main/guardartasa',  [
	'middleware' => 'auth',
	'uses'		 => 'Configuracion\TasasController@store',
	'as' 		 => 'guardartasa'
]);
/*
| Ubicacion Geografica 
*/

/* Sectores */
Route::get('main/sectores',  [
	'middleware' => 'auth',
	'uses'		 => 'Configuracion\SectoresController@index',
	'as' 		 => 'sectores'
]);

Route::post('main/guardarsector',  [
	'middleware' => 'auth',
	'uses'		 => 'Configuracion\SectoresController@store',
	'as' 		 => 'guardarsector'
]);

/* Vias |Avenidas - Calles|Principales - Secundarias */
Route::get('main/vias',  [
	'middleware' => 'auth',
	'uses'		 => 'Configuracion\ViasController@index',
	'as' 		 => 'vias'
]);

Route::post('main/guardarvia',  [
	'middleware' => 'auth',
	'uses'		 => 'Configuracion\ViasController@store',
	'as' 		 => 'guardarvia'
]);

Route::get('main/barrio',  [
	'middleware' => 'auth',
	'uses'		 => 'Configuracion\BarriosController@index',
	'as' 		 => 'barrios'
]);

Route::post('main/guardarbarrio',  [
	'middleware' => 'auth',
	'uses'		 => 'Configuracion\BarriosController@store',
	'as' 		 => 'guardarbarrio'
]);
/*
| Fin Ubicacion Geografica 
*/
/*
| Lote Valor Fiscal
*/
Route::get('main/lotefiscal',  [
	'middleware' => 'auth',
	'uses'		 => 'Configuracion\LoteFiscalController@index',
	'as' 		 => 'lotefiscal'
]);
Route::post('main/guardarlote',  [
	'middleware' => 'auth',
	'uses'		 => 'Configuracion\LoteFiscalController@store',
	'as' 		 => 'guardarlote'
]);
/*
| Fin Lote Valor Fiscal
*/
/*
| Tarifas de Desechos Solidos
*/
Route::get('main/tarifas',  [
	'middleware' => 'auth',
	'uses'		 => 'Configuracion\TarifasController@index',
	'as' 		 => 'tarifas'
]);
Route::post('main/guardartarifa',  [
	'middleware' => 'auth',
	'uses'		 => 'Configuracion\TarifasController@store',
	'as' 		 => 'guardartarifa'
]);
/*
| Fin Tarifas de Desechos Solidos
*/
/*
|--------------------------------------------------------------------------
| Fin configuracion
|--------------------------------------------------------------------------
*/
/*  
| Tipo de Tramites del Contribuyente
*/
/* Listar los tipo de tramites */
Route::get('main/tipotramites',  [
	'middleware' => 'auth',
	'uses'		 => 'Configuracion\TipoTramitesController@index',
	'as' 		 => 'tipotramites'
]);
/* Guardar nuevo tramite*/
Route::post('main/guardartipotramite',  [
	'middleware' => 'auth',
	'uses'		 => 'Configuracion\TipoTramitesController@store',
	'as' 		 => 'guardartipotramite'
]);
/* Listar requisitos para asociarlos al tramite */
Route::get('main/trareq/{id}',  [
	'middleware' => 'auth',
	'uses'		 => 'Configuracion\TipoTramitesController@requisitos',
	'as' 		 => 'trareq'
]);
/* Asociar requisitos al tramite */
Route::post('main/asociartrareq',  [
	'middleware' => 'auth',
	'uses'		 => 'Configuracion\TipoTramitesController@asociartrareq',
	'as' 		 => 'asociartrareq'
]);
/* Listar las tasas para asociarlos al tramite */
Route::get('main/tramtasas/{id}',  [
	'middleware' => 'auth',
	'uses'		 => 'Configuracion\TipoTramitesController@tasas',
	'as' 		 => 'tramtasas'
]);
/* Asociar requisitos al tramite */
Route::post('main/asociartramtasa',  [
	'middleware' => 'auth',
	'uses'		 => 'Configuracion\TipoTramitesController@asociartramtasa',
	'as' 		 => 'asociartramtasa'
]);
/*
|--------------------------------------------------------------------------
| Fin Configuracion
|--------------------------------------------------------------------------
*/
/*
|--------------------------------------------------------------------------
| Menu Seguridad
|--------------------------------------------------------------------------
*/

/*| Proceso de Migracion Sectores |*/
Route::get('/main/seguridad/migrar', 'Migracion\MigracionController@index')->name('migrar');
Route::post('/main/seguridad/migracion', 'Migracion\MigracionController@migracion')->name('migracion');	
Route::get('/main/seguridad/resultados', 'Migracion\MigracionController@resultados')->name('resultados');

/* |Sessiones| */
Route::get('/main/seguridad/sesiones', 'Configuracion\SesionesController@index')->name('sesiones');

/*| Direcciones IP |*/
Route::get('/main/direccionesip','Configuracion\SesionesController@index')->name('direccionesip');

/*| Cuentas de Usuario |*/
Route::get('/main/cuentasusuarios','Seguridad\CuentasUsuariosController@index')->name('cuentasusuarios');
Route::post('/main/cuentasusuarios/nuevousuario','Seguridad\CuentasUsuariosController@store')->name('nuevousuario');
Route::post('/main/cuentasusuarios/actualizarpassword','Seguridad\CuentasUsuariosController@password')->name('actualizarpassword');
Route::post('/main/cuentasusuarios/inactivar','Seguridad\CuentasUsuariosController@inactivar')->name('inactivar');
Route::get('/main/seguridad/perfiles','Seguridad\CuentasUsuariosController@perfiles')->name('perfiles');

Route::get('/main/seguridad/generarmov/', 'Seguridad\GenerarMovController@generarmovimiento')->name('generarmov');

/*
|--------------------------------------------------------------------------
| Menu Configuracion
|--------------------------------------------------------------------------
*/
/*
|--------------------------------------------------------------------------
| Cuenta de Usuarios
|--------------------------------------------------------------------------
*/
Route::get('/main/usuarios',  [
	'middleware' => 'auth',
	'uses'		 => 'Configuracion\SesionesController@index',
	'as' 		 => 'usuarios'
]);