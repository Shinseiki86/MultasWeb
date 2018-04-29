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
});

Route::group(['middleware'=>'auth'], function() {
	Route::get('/', function(){
		if(Entrust::hasRole(['owner','admin','gesthum']))
			return view('dashboard/charts');
		return view('layouts.menu');
	});
	Route::get('getArrModel', 'Controller@ajax');


});


Route::group(['prefix'=>'core', 'middleware'=>'auth'], function() {
	Route::resource('propietarios', 'PropietarioController', ['except'=>['show'], 'parameters'=>['propietario'=>'PROP_ID']]);
	Route::resource('vehiculos', 'VehiculoController', ['except'=>['show'], 'parameters'=>['vehiculo'=>'VEHI_ID']]);
	Route::resource('multas', 'MultaController', ['except'=>['show'], 'parameters'=>['multa'=>'MULT_ID']]);
	Route::get('multas/getTable', 'MultaController@getData');
});


Route::get('getMultas/{cedula}', 'MultaController@getMultasJson');



