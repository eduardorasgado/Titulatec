<?php

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

// HTTP
Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => ['IsAdmin']], function() {
    // aqui van las peticiones que se relacionan con las acciones del administrador
    // rutas para opcion de titulacion
    Route::resource('OpcionTitulacion', 'OpcionTitulacionController',
        ['except' => ['index']]);
    // rutas para modificacion o visualizacion de roles
    Route::resource('Roles', 'RoleController');
    // rutas para academias
    Route::resource('Academia', 'AcademiaController',
        ['except' => ['index', 'show']]);

});

Route::group(['middleware' => ['auth']], function() {
    // rutas que todos pueden acceder
    // usualmente los get
    Route::resource('OpcionTitulacion', 'OpcionTitulacionController',
        ['only' => ['index']]);

    // rutas para academias
    Route::resource('Academia', 'AcademiaController',
        ['only' => ['index', 'show']]);
});