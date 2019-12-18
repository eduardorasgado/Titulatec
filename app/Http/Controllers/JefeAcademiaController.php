<?php

namespace App\Http\Controllers;

use App\Academia;
use App\Alumno;
use App\Asesores;
use App\Http\Requests\AsesoresRequest;
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
            true, $idAcademia)
            ->orderBy('id', 'desc')
            ->paginate(6, ['*'], 'set1');
        $alumnosSinAsesores = ProcesoTitulacion::fullDataFindByRegistroProyectoAndidAcademia(
            false, $idAcademia)
            ->orderBy('id', 'asc')
            ->paginate(6, ['*'], 'set2');

        return view('dashboards.jefeAcademia.sinodales.home',
                compact('alumnosConAsesores', 'alumnosSinAsesores', 'idAcademia'));
    }

    /**
     * Funcion que retorna el resultado de una busqueda de cierta sinodalia dado un numero de control de alumno
     */
    public function sinodaliaSearch(Request $request) {
        //
        $idAcademia = $request->input('idAcademia');
        $num_control = $request->input('control');
        $alumno = User::findByNumeroControl($num_control)->first();
        if($alumno != null) {
            if($alumno["alumno"]["procesoTitulacion"]["memorandum"]) {
                return view('dashboards.jefeAcademia.sinodales.sinodalSearch',
                        compact('idAcademia', 'alumno'));
            }
        } else {
            return dd("No se pudo encontrar nada");
        }
    }

    /**
     * funciones para las rutas de la sinodalia de un alumno especifico
     */

    public function showSinodalia($idAcademia, $idAlumno) {
        // retornando al alumno
        $alumno = User::alumnoWithAsesoresfindByidAlumno($idAlumno)->first();
        // retornando a todos los maestros del departamento incluido el jefe
        $maestros = User::maestrosAndJefeAcademiaWithMaestroAndAcademiaByAcademia($idAcademia)->get();

        return view('dashboards.jefeAcademia.sinodales.asignacionAsesores',
                compact('alumno', 'maestros', 'idAcademia', 'idAlumno'));
    }

    public function createSinodalia(AsesoresRequest $request, $idAcademia, $idAlumno) {

        // Asignacion de asesores
        try {
            $alumno = Alumno::findOrFail($idAlumno);
            if($alumno) {
                $proceso = $alumno->procesoTitulacion;
                if($proceso){
                    $presidente = $request->input('presidente');
                    $secretario = $request->input('secretario');
                    $vocal = $request->input('vocal');
                    $vocalSuplente = $request->input('vocal_suplente');

                    // lo ocupamos al sumar y restar en asesor count adelante
                    $asesores = $proceso->asesores;

                    // crea en caso de no existir una fila en asesores con el proceso determinado
                    $newAsesores = Asesores::updateOrCreate(
                        ['id_proceso_titulacion' => $proceso->id],
                        [
                        'id_presidente' => $presidente,
                        'id_secretario' => $secretario,
                        'id_vocal' => $vocal,
                        'id_vocal_suplente' => $vocalSuplente,
                    ]);

                    //TODO: Actualizamos el proceso de titulacion del alumno
                    $proceso->registro_proyecto = true;
                    $proceso->save();

                    // sumamos a asesor count uno a cada maestro nuevo
                    $newPresidente = Maestro::find($newAsesores->id_presidente);
                    $newSecretario = Maestro::find($newAsesores->id_secretario);
                    $newVocal = Maestro::find($newAsesores->id_vocal);
                    $newVocalSuplente = Maestro::find($newAsesores->id_vocal_suplente);

                    $newPresidente->asesor_count += 1;
                    $newSecretario->asesor_count += 1;
                    $newVocal->asesor_count += 1;
                    $newVocalSuplente->asesor_count += 1;

                    $newPresidente->save();
                    $newSecretario->save();
                    $newVocal->save();
                    $newVocalSuplente->save();

                    // restamos a asesor count a cada maestro
                    if($asesores) {
                        $pastPresidente = Maestro::find($asesores->id_presidente);
                        $pastSecretario = Maestro::find($asesores->id_secretario);
                        $pastVocal = Maestro::find($asesores->id_vocal);
                        $pastVocalSuplente = Maestro::find($asesores->id_vocal_suplente);

                        $pastPresidente->asesor_count -= 1;
                        $pastSecretario->asesor_count -= 1;
                        $pastVocal->asesor_count -= 1;
                        $pastVocalSuplente->asesor_count -= 1;

                        $pastPresidente->save();
                        $pastSecretario->save();
                        $pastVocal->save();
                        $pastVocalSuplente->save();

                    }

                    // actualizar los estados de cada uno de los seleccionados
                    return redirect()->back()->with('success', 'Se han establecido asesores');
                }else {
                    return redirect()->back()->with('Error', 'No existe el proceso de titulación');
                }

            }

        } catch (\Exception $e) {
            return redirect()->back()->with('Error', 'No se ha encontrado al alumno');
        }
    }

    public function showSinodaliaNoUpdatable($idAcademia, $idAlumno) {
        // retornar datos de alumno
        // retornar los asesores
        $user = User::alumnoWithAsesoresfindByidAlumno($idAlumno)->first();
        $alumno = $user->alumno;

        $presidente = Maestro::findOrFail($alumno["procesoTitulacion"]["asesores"]["id_presidente"])->user;
        $secretario = Maestro::findOrFail($alumno["procesoTitulacion"]["asesores"]["id_secretario"])->user;
        $vocal = Maestro::findOrFail($alumno["procesoTitulacion"]["asesores"]["id_vocal"])->user;
        $vocal_suplente = Maestro::findOrFail($alumno["procesoTitulacion"]["asesores"]["id_vocal_suplente"])->user;

        $proyecto = $user->alumno->proyecto;
        $especialidad = $user->alumno->carrera->especialidad;

        return view('dashboards.jefeAcademia.sinodales.visualizarAsesores',
            compact(
                'idAcademia',
                'user',
                'alumno',
                'presidente',
                'secretario',
                'vocal',
                'vocal_suplente',
                'proyecto',
                'especialidad'
            )
        );
    }
}
