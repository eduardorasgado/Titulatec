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

use App\Http\Controllers\ProyectoController;

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
    // cambio de la pass en la primera sesion
    Route::post(
        '/password/change/default',
        'HomeController@passwordUpdate'
    )->name('Auth.password.default.change');

    Route::get('/password/change',
            'HomeController@editPassword'
        )
        ->name('Auth.password.change');

    // para el cambio de la contrasena en la
    Route::post(
        '/password/change',
        'HomeController@updatePassword'
    )->name('Auth.password.change');

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

Route::group(['middleware' => ['IsJefeAcademia']], function() {
    // rutas para creacion de maestros
   Route::get('/JefeAcademia/Administrar/Maestro/agregar',
            'JefeAcademiaController@createMaestro'
       )
   ->name('JefeAcademia.Manage.Maestro.create');

   Route::post('/JefeAcademia/Administrar/Maestro/agregar',
            'JefeAcademiaController@storeMaestro')
       ->name('JefeAcademia.Manage.Maestro.create');

   // ruta de visualizacion de maestros por jefe de academia
    Route::get('/JefeAcademia/{academia_id}/Administrar/Maestro',
            'JefeAcademiaController@indexMaestros')
        ->name('JefeAcademia.Manage.Maestros.visualizar');

    // rutas para el dashboard de -----------------------SINODALIAS
    Route::get('/JefeAcademias/{idAcademia}/Sinodalia',
            'JefeAcademiaController@indexSinodalia'
        )
        ->name('JefeAcademia.Manage.Sinodalia.index');

    Route::post('/busqueda/sinodalias',
        'JefeAcademiaController@sinodaliaSearch'
        )->name('Sinodalia.busqueda');

    Route::get('/JefeAcademias/{idAcademia}/Sinodalia/Alumno/{idAlumno}/Asignacion/Asesores',
                'JefeAcademiaController@showSinodalia')
        ->name('Sinodalia.show');

    Route::post('/JefeAcademias/{idAcademia}/Sinodalia/Alumno/{idAlumno}/Asignacion/Asesores',
        'JefeAcademiaController@createSinodalia')
        ->name('Sinodalia.new');

    // generar respuesta de departamento por jefe de academia
    Route::get('/JefeAcademia/generate/Alumno/{idAlumno}/respuesta-departamento/pdf',
                'DocumentacionController@generateRespuestaDepartamento')
        ->name('JefeAcademia.Generate.RespuestaDepartamento');

    // generar respuesta de departamento por jefe de academia
    Route::get('/JefeAcademias/{idAcademia}/Sinodalia/Alumno/{idAlumno}/Visualizar/Asesores',
        'JefeAcademiaController@showSinodaliaNoUpdatable')
        ->name('JefeAcademia.Alumno.Visualizar.Asesores');
});

Route::group(['middleware' => ['IsDivisionEstudios']], function() {
    Route::resource('DivisionEstudios', 'DivisionEstudiosController',
        ['only' => ['edit', 'update']]);

    // Rutas para memorandum
    Route::get('/DivisionEstudios/Alumno/{idAlumno}/solicitud/memorandum/generatePDF/{vistaPrevia}/pdf',
            'DocumentacionController@memorandum')
            ->name('Alumno.memorandum.generate');

    Route::get('/DivisionEstudios/home/Memorandum',
                'DivisionEstudiosController@memorandumDashboard')
                ->name('Memorandum.dashboard');

    
    Route::post('/busqueda/memorandums',
                'DivisionEstudiosController@memorandumSearch'
    )->name('Memorandum.busqueda');
    
    // Rutas para avisos
    Route::get('/DivisionEstudios/home/Avisos',
                'DivisionEstudiosController@avisosDashboard')
        ->name('DivisionEstudios.Alumno.Avisos.generate');

    // ruta para mostrar el formulario para definir tiempo de aviso, se muestra con el proyecto del alumno
    // y con un boton de generacion de pdf
    Route::get('/DivisionEstudios/Alumno/{idAlumno}/Avisos',
        'DivisionEstudiosController@createAvisos')
        ->name('Alumno.avisos.create');

    Route::post('/DivisionEstudios/Alumno/{idAlumno}/ProcesoTitulacion/{idProcesoTitulacion}/Avisos',
                'DivisionEstudiosController@storeAvisos')
        ->name('Alumno.avisos.store');

    // Generacion de pdf del aviso de determinado alumno
    Route::get('/DivisionEstudios/Alumno/{idAlumno}/Proceso-titulacion/{idProceso}/Avisos/generate/pdf',
        'DocumentacionController@generateAvisos')
        ->name('DivisionEstudios.Alumno.Avisos.generate.pdf');
});

Route::group(['middleware' => ['IsServiciosEscolares']], function() {
    Route::resource('ServiciosEscolares', 'ServiciosEscolaresController',
        ['only' => ['edit', 'update']]);

    Route::resource('Libros', 'LibroController');

    // rutas para generacion de actas
    Route::resource('Acta', 'ActaController');

    Route::get(
        '/ServiciosEscolares/Alumno/{idAlumno}/Acta/Generate',
        'DocumentacionController@generateActa'
    )->name('Alumno.acta.generate');

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

    Route::get('Alumno/{id}/proyecto/select',
        'ProyectoController@accessProyectSelector'
    )->name('Proyecto.Selector');

    Route::put('Alumno/{id}/datosProfesionales',
        'AlumnoController@saveDatosProfesionales')
        ->name('Alumno.datosProfesionales');

    Route::get('Alumno/{id}/datosProfesionales',function () {
        return redirect('/');
    })
        ->name('Alumno.datosProfesionales.showForm');

    Route::get('Alumno/{id}/update',
        'AlumnoController@editAgainAlumnoDato')
        ->name('Alumno.Datos.Modificar');

});
