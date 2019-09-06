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


// https://laravel.com/docs/5.2/controllers#restful-naming-resource-routes
Route::group(['middleware' => ['IsAdmin']], function() {
    // aqui van las peticiones que se relacionan con las acciones del administrador
    // rutas para opcion de titulacion
    Route::resource('OpcionTitulacion', 'OpcionTitulacionController',
        ['except' => ['index', 'show']]);
    // rutas para modificacion o visualizacion de roles
    Route::resource('Role', 'RoleController');
    // rutas para academias
    Route::resource('Academia', 'AcademiaController',
        ['except' => ['index', 'show']]);
    // rutas para las especialidades, que dependen de las academias
    Route::resource('Especialidad', 'EspecialidadController',
        ['except' => ['index', 'show']]);

    Route::resource('PlanEstudio', 'PlanEstudiosController',
        ['except' => ['index', 'show']]);

    Route::resource('Maestro', 'MaestroController',
        ['only' => ['create', 'store', 'destroy']]);

    Route::resource('DivisionEstudios', 'DivisionEstudiosController',
        ['only' => ['create', 'store', 'destroy']]);

    Route::get('/DivisionEstudios/Jefe/edit',
        'DivisionEstudiosController@asignarJefeEdit')
        ->name('DivisionEstudios.jefe.edit');

    Route::post('/DivisionEstudios/Jefe/update',
        'DivisionEstudiosController@asignarJefeUpdate')
        ->name('DivisionEstudios.jefe.update');

    Route::get('/DivisionEstudios/Jefe/update', function() {
        return redirect('/');
    })->name('DivisionEstudios.jefe.update');

    // coordinadora de apoyo a la titulacion
    Route::get('/DivisionEstudios/Coordinadora-apoyo-titulacion/edit',
        'DivisionEstudiosController@asignarCoordinadoraApoyoTitulacionEdit')
        ->name('DivisionEstudios.coordinador.edit');

    Route::post('/DivisionEstudios/Coordinadora-apoyo-titulacion/update',
        'DivisionEstudiosController@asignarCoordinadoraApoyoTitulacionUpdate')
        ->name('DivisionEstudios.coordinador.update');

    Route::get('/DivisionEstudios/Coordinadora-apoyo-titulacion/update', function() {
        return redirect('/');
    })->name('DivisionEstudios.coordinador.update');

    Route::resource('ServiciosEscolares', 'ServiciosEscolaresController',
        ['only' => ['create', 'store', 'destroy']]);

    Route::get('/JefesAcademia', 'JefeAcademiaController@index')
        ->name('JefesAcademia.index');

    Route::post('/JefesAcademia/{academia}', 'JefeAcademiaController@update')
        ->name('JefesAcademia.update');

    Route::get('/JefesAcademia/{academia}', function(){
        return redirect("/");
    });
});

Route::group(['middleware' => ['auth']], function() {
    // rutas que todos pueden acceder
    // usualmente los get

    // Reubicar este tema
    Route::post(
        '/password/change/default',
        'HomeController@passwordUpdate'
    )->name('Auth.password.default.change');

    Route::resource('OpcionTitulacion', 'OpcionTitulacionController',
        ['only' => ['index', 'show']]);

    // rutas para academias
    Route::resource('Academia', 'AcademiaController',
        ['only' => ['index', 'show']]);

    // rutas para especialidades
    Route::resource('Especialidad', 'EspecialidadController',
        ['only' => ['index', 'show']]);

    Route::resource('PlanEstudio', 'PlanEstudiosController',
        ['only' => ['index', 'show']]);

    // ruta para conseguir todos los planes de estudio por especialidad
    Route::get('/Especialidad/{id}/PlanesEstudio',
        'PlanEstudiosController@getAllByEspecialidad');

    Route::resource('Maestro', 'MaestroController',
        ['only' => ['index', 'show']]);

    Route::resource('DivisionEstudios', 'DivisionEstudiosController',
        ['only' => ['index', 'show']]);

    Route::resource('ServiciosEscolares', 'ServiciosEscolaresController',
        ['only' => ['index', 'show']]);

    Route::resource('AlumnoCarrera', 'AlumnoCarreraController',
        ['only' => ['index', 'show']]);
});


Route::group(['middleware' => ['IsMaestro']], function() {
    Route::resource('Maestro', 'MaestroController',
        ['only' => ['edit', 'update']]);

});

Route::group(['middleware' => ['IsDivisionEstudios']], function() {
    Route::resource('DivisionEstudios', 'DivisionEstudiosController',
        ['only' => ['edit', 'update']]);

    Route::get('/Alumno/{idAlumno}/solicitud/memorandum/generatePDF',
            'DocumentacionController@memorandum')
            ->name('Alumno.memorandum.generate');

    Route::get('/home/Memorandum',
                'DivisionEstudiosController@memorandumDashboard')
                ->name('Memorandum.dashboard');
});

Route::group(['middleware' => ['IsServiciosEscolares']], function() {
    Route::resource('ServiciosEscolares', 'ServiciosEscolaresController',
        ['only' => ['edit', 'update']]);
});

Route::group(['middleware' => ['IsAlumno']], function() {
    Route::resource('AlumnoCarrera', 'AlumnoCarreraController',
        ['only' => ['edit', 'update', 'create', 'destroy']]);

    Route::resource('Alumno', 'AlumnoController');

    Route::resource('Proyecto', 'ProyectoController',
        ['only' => ['edit', 'update', 'create', 'store']]);

    Route::post('/Alumno/{idAlumno}/verificacion-codigo',
                'ProyectoController@exchangeProyectoCode')
                ->name('Alumno.verificar.codigo');

    Route::get('/generateToken',
                'ProyectoController@generateCode')
        ->name('Code.generate');

    Route::resource('ProcesoTitulacion', 'ProcesoTitulacionController');

    Route::get('Alumno/{id}/Solicitud/Titulacion/generatePDF',
            'DocumentacionController@solicitudTitulacion'
        )->name('SolicitudTitulacion.generate');
});
