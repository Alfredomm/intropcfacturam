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

Route::get('/login', function()
{
	return View::make('login');
});

Route::get('/', function()
{
	return View::make('login');
});

Route::get('ajustes', function()
{
	return View::make('ajustes.index', array('active' => 'ajustes'));
});

/****************************************************************************************************
************************ Actions Handled By Resource Controller *************************************

Verb			Path							Action			Route Name
--------------------------------------------------------------------------------
GET				/resource						index			resource.index

GET				/resource/create				create			resource.create

POST			/resource						store			resource.store

GET				/resource/{resource}			show			resource.show

GET				/resource/{resource}/edit		edit			resource.edit

PUT/PATCH		/resource/{resource}			update			resource.update

DELETE			/resource/{resource}			destroy			resource.destroy

************************ End of Actions Handled By Resource Controller ******************************
****************************************************************************************************/

Route::get('clientes/contacts/{id}', array( 'as' => 'clientes.contacts', 'uses' => 'ClientesController@contacts'));

Route::get('clientes/filter', array( 'as' => 'clientes.filter', 'uses' => 'ClientesController@filter' ));

Route::get('materiales/filter', array( 'as' => 'materiales.filter', 'uses' => 'MaterialesController@filter'));

Route::get('postalcodigos/filter', array( 'as' => 'postalcodigos.filter', 'uses' => 'PostalcodigosController@filter'));

Route::get('empleados/filter', array( 'as' => 'empleados.filter', 'uses' => 'EmpleadosController@filter'));

Route::get('empleados/contacts/{id}', array( 'as' => 'empleados.contacts', 'uses' => 'EmpleadosController@contacts'));

Route::get('empresas/contacts/{id}', array( 'as' => 'empresas.contacts', 'uses' => 'EmpresasController@contacts'));

Route::post('facturas/verification', array( 'as' => 'facturas.verification', 'uses' => 'FacturasController@verification'));

Route::get('facturas/tipodoc/{tipo}', array( 'as' => 'facturas.tipodoc', 'uses' => 'FacturasController@tipodoc'));

Route::get('facturas/createtipo/{tipo}', array( 'as' => 'facturas.createtipo', 'uses' => 'FacturasController@createtipo'));

Route::get('facturas/convert/{id}', array( 'as' => 'facturas.convert', 'uses' => 'FacturasController@convert' ));

Route::get('facturas.convertRectificativa/{id}', array( 'as' => 'facturas.convertRectificativa', 'uses' => 'FacturasController@convertRectificativa' ));

Route::post('users/login', array( 'as' => 'users.login', 'uses' => 'UsersController@login'));

Route::get('users/logout', array( 'as' => 'users.logout', 'uses' => 'UsersController@logout'));

Route::get('facturas/verificationshow/{tipo}/{tipologia}/{id}', array( 'as' => 'facturas.verificationshow', 'uses' => 'FacturasController@verificationshow' ));

Route::post('facturas/createline', array( 'as' => 'facturas.createline', 'uses' => 'FacturasController@createline'));

Route::get('facturas/search', array( 'as' => 'facturas.search', 'uses' => 'FacturasController@search'));

Route::get('facturas/searchnum', array( 'as' => 'facturas.searchnum', 'uses' => 'FacturasController@searchnum'));

Route::get('facturas/createlineshow/{tipo}/{id}/{mat?}', array( 'as' => 'facturas.createlineshow', 'uses' => 'FacturasController@createlineshow' ));

Route::post('facturas/refreshmaterial', array( 'as' => 'facturas.refreshmaterial', 'uses' => 'FacturasController@refreshmaterial' ));

Route::post('facturas/addline', array( 'as' => 'facturas.addline', 'uses' => 'FacturasController@addline'));

Route::post('facturas/listamateriales', array( 'as' => 'facturas.listamateriales', 'uses' => 'FacturasController@listamateriales' ));

Route::post('facturas/listaclientes', array( 'as' => 'facturas.listaclientes', 'uses' => 'FacturasController@listaclientes' ));

Route::get('facturas/duplicate/{id}/{tipo?}', array( 'as' => 'facturas.duplicate', 'uses' => 'FacturasController@duplicate' ));

Route::get('facturas/resumen', array( 'as' => 'facturas.resumen', 'uses' => 'FacturasController@resumen' ));

Route::get('facturas/busquedares', array( 'as' => 'facturas.busquedares', 'uses' => 'FacturasController@busquedares' ));

Route::resource('empresas', 'EmpresasController');

Route::resource('empleados', 'EmpleadosController');

Route::resource('clientes', 'ClientesController');

Route::resource('telefonos', 'TelefonosController');

Route::resource('faxs', 'FaxsController');

Route::resource('emails', 'EmailsController');

Route::resource('postalcodigos', 'PostalcodigosController');

Route::resource('tipos', 'TiposController');

Route::resource('tiposiva', 'TiposivaController');

Route::resource('permisos', 'PermisosController');

Route::resource('materiales', 'MaterialesController');

Route::resource('facturalineas', 'FacturalineasController');

Route::resource('facturas', 'FacturasController');

Route::resource('usuarios', 'UsuariosController');