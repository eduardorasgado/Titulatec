<?php

namespace App\Http\Controllers;

use App\Academia;
use App\Alumno;
use App\Http\Requests\MaestroRequest;
use App\Maestro;
use App\ProcesoTitulacion;
use App\Role;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JefeAcademiaController extends Controller
{
    private $genericErrorMessage = "Ha existido un error al intentar agregar un nuevo jefe de academia";

    public function index() {
        // devolvemos a todos los jefes y a todos los maestros
        $jefes = User::jefesWithMaestroAndAcademia()->get();
        $maestros = User::maestrosWithMaestroAndAcademia()->get();

        $academias = Academia::all();

        return view('dashboards.administrador.cuentas.asignacion.jefeAcademia',
            compact('jefes', 'maestros', 'academias'));
    }
    //
    public function update(Request $request, $academia) {

        if($request->input('jefe') != $request->input('jefeActual')) {
            // asignamos el nuevo jefe
            if($request->input('jefe')) {
                if(!empty($request->input('jefe'))) {
                    $newJefe = User::find($request->input('jefe'));
                    if($newJefe) {
                        $academiaDelJefe = $newJefe->maestro->academia;
                        if($academiaDelJefe->id == $academia) {
                            $newJefe->id_role = Role::$ROLE_JEFE_ACADEMIA;
                            $newJefe->save();

                            // ahora se actualiza el jefe antiguo a maestro
                            if($request->input('jefeActual')) {
                                // si existe lo buscamos y le cambiamos el rol a maestro de nuevo
                                $jefeActual = User::find($request->input('jefeActual'));
                                if($jefeActual) {
                                    $jefeActual->id_role = Role::$ROLE_MAESTRO;
                                    $jefeActual->save();
                                }
                            }
                            return redirect()->back()->with("success",
                                "Se ha actualizado el jefe con éxito: ".$academiaDelJefe->nombre);
                        }
                    }
                    return redirect()->back()->with("error",
                        $this->genericErrorMessage);
                }
            }
            return redirect()->back()->with("error", "Selecciona un elemento antes de guardar");
        }
        return redirect()->back();
    }

    /**
     * Visualizacion de todos los maestros de la academia
     */
    public function indexMaestros($idAcademia) {
        $academia = Academia::find($idAcademia);
        $maestros = User::maestrosWithMaestroAndAcademiaByAcademia($idAcademia)->get();
        return view('dashboards.jefeAcademia.visualizacion.maestro',
                compact('maestros', 'academia'));
    }

    /**
     * Trae el formulario de la creacion de un maestro
     */
    public function createMaestro() {
        $jefeAcademia = Maestro::findByUserId(Auth::user()->id)->first()->id_academia;
        $academias = Academia::where('id', $jefeAcademia)->get();

        return view('dashboards.jefeAcademia.creacion.maestro',
            compact('academias'));
    }

    public function storeMaestro(MaestroRequest $request) {
        try {
            // uso de una clase mediante el contenedor de aplicaciones de la Inyeccion de dependencias de laravel
            $maestroController = app('App\Http\Controllers\MaestroController');
            $maestroController->storeNewMaestro($request);
            return redirect()->back()->with('success', $maestroController->maestroSuccessMessage);
        } catch (\Exception $e) {
            return redirect()->back()->with('Error', 'Error al intentar crear un maestro');
        }
    }

    // FUNCIONES PARA LAS SINODALIAS

    /**
     * Retorna al dashboard de muestra de alumnos
     * @param $idAcademia
     */
    public function indexSinodalia($idAcademia){
        $alumnosConAsesores =  ProcesoTitulacion::fullDataFindByRegistroProyectoAndidAcademia(
            true, $idAcademia)->get();
        $alumnosSinAsesores = ProcesoTitulacion::fullDataFindByRegistroProyectoAndidAcademia(
            false, $idAcademia)->get();
        return view('dashboards.jefeAcademia.sinodales.home',
                compact('alumnosConAsesores', 'alumnosSinAsesores', 'idAcademia'));
    }

    /**
     * funciones para las rutas de la sinodalia de un alumno especifico
     */

    public function showSinodalia($idAcademia, $idAlumno) {
        // retornando al alumno
        $alumno = User::findByIdAlumno($idAlumno)->first();
        // retornando a todos los maestros del departamento incluido el jefe
        $maestros = User::maestrosAndJefeAcademiaWithMaestroAndAcademiaByAcademia($idAcademia);
        return view('dashboards.jefeAcademia.sinodales.asignacionAsesores',
                compact('alumno', 'maestros'));
    }
}
