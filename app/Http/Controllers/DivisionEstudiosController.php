<?php

namespace App\Http\Controllers;

use App\Acta;
use App\Http\Requests\AvisoRequest;
use App\Http\Requests\PersonalDepartamentoRequest;
use App\Maestro;
use App\ProcesoTitulacion;
use App\Role;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class DivisionEstudiosController extends Controller
{
    private $divisionCreateSuccessMessage = 'Se ha creado correctamente el personal de division de estudios, puede'.
                ' ya accesar al sistema con la contraseña *password* que debe cambiar en su primera sesión';

    private $genericErrorMessage = 'Ocurrió un error al intentar actualizar el jefe, intente más tarde';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        //
        $divisionEstudios = User::divisionEstudios()->get();
        $roleJefe = Role::$ROLE_JEFE_DIVISION;
        $roleCoordinador = Role::$ROLE_COORDINADORA_APOYO_TITULACION;

        return view('dashboards.administrador.cuentas.listado.divisionEstudios',
            compact('divisionEstudios', 'roleJefe', 'roleCoordinador'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('dashboards.administrador.cuentas.creacion.divisionEstudios');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PersonalDepartamentoRequest $request)
    {
        //
        $divisionEstudiosUser = User::create([
            'nombre' => $request->input('nombre'),
            'apellidos' => $request->input('apellidos'),
            'email' => $request->input('email'),
            'password' => Hash::make('password'),
            // activado: true
            'is_enable' => 1,
            // secretaria de division de estudios role
            'id_role' => 3
        ]);

        return redirect()->back()->with('success', $this->divisionCreateSuccessMessage);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    // custom funtions

    public function memorandumDashboard() {
        $alumnos = User::withFullDEData()->get();
        $alumnosConMemorandum = [];
        $alumnosSinMemorandum = [];

        foreach ($alumnos as $alumno) {
            if($alumno["alumno"]["procesoTitulacion"]["solicitud_titulacion"] &&
                !$alumno["alumno"]["procesoTitulacion"]["memorandum"]) {
                array_push($alumnosSinMemorandum, $alumno);
            }
            if($alumno["alumno"]["procesoTitulacion"]["solicitud_titulacion"] &&
                $alumno["alumno"]["procesoTitulacion"]["memorandum"]) {
                array_push($alumnosConMemorandum, $alumno);
            }
        }
        return view('dashboards.secretariaDivision.secciones.memorandumList',
            compact('alumnosConMemorandum', 'alumnosSinMemorandum'));
    }

    public function avisosDashboard() {
        $alumnos = User::withFullDEData()->get();
        $alumnosConAvisos = [];
        $alumnosSinAvisos = [];

        foreach ($alumnos as $alumno) {
            if($alumno["alumno"]["procesoTitulacion"]["solicitud_titulacion"] &&
                $alumno["alumno"]["procesoTitulacion"]["memorandum"] &&
                $alumno["alumno"]["procesoTitulacion"]["registro_proyecto"] &&
                !$alumno["alumno"]["procesoTitulacion"]["avisos"]) {
                array_push($alumnosSinAvisos, $alumno);
            }
            if($alumno["alumno"]["procesoTitulacion"]["solicitud_titulacion"] &&
                $alumno["alumno"]["procesoTitulacion"]["memorandum"] &&
                $alumno["alumno"]["procesoTitulacion"]["registro_proyecto"] &&
                $alumno["alumno"]["procesoTitulacion"]["avisos"]) {
                array_push($alumnosConAvisos, $alumno);
            }
        }
        return view('dashboards.secretariaDivision.secciones.avisosList',
                compact('alumnosConAvisos', 'alumnosSinAvisos'));
    }

    /**
     * Muestra el formulario para asignar al jefe
     */
    public function asignarJefeEdit() {
        $divisionEstudios = User::divisionEstudios()->get();
        $divisionRole = Role::find(Role::$ROLE_JEFE_DIVISION);
        return view('dashboards.administrador.cuentas.asignacion.jefeDivisionEstudios',
                compact('divisionEstudios', 'divisionRole'));
    }

    public function asignarJefeUpdate(Request $request) {
        // asignamos el nuevo jefe
        if($request->input('jefe') != $request->input('jefeActual')) {
            if($request->input('jefe')) {
                if(!empty($request->input('jefe'))) {
                    $newJefe = User::find($request->input('jefe'));
                    if($newJefe) {
                        $newJefe->id_role = Role::$ROLE_JEFE_DIVISION;
                        $newJefe->save();
                        // ahora se actualiza el jefe antiguo a maestro
                        if($request->input('jefeActual')) {
                            // si existe lo buscamos y le cambiamos el rol a maestro de nuevo
                            $jefeActual = User::find($request->input('jefeActual'));
                            if($jefeActual) {
                                $jefeActual->id_role = Role::$ROLE_SECRETARIA_DIVISION;
                                $jefeActual->save();
                            }
                        }
                        return redirect()->back()->with("success",
                            "Se ha actualizado el jefe con éxito: ");

                    }
                    return redirect()->back()->with("error",
                        $this->genericErrorMessage);
                }
            }
            return redirect()->back()->with("error", "Selecciona un elemento antes de guardar");
        }
        return redirect()->back();
    }

    public function asignarCoordinadoraApoyoTitulacionUpdate(Request $request) {
        // asignamos el nuevo jefe
        if($request->input('coordinador') != $request->input('coordinadorActual')) {
            if($request->input('coordinador')) {
                if(!empty($request->input('coordinador'))) {
                    $newCoordinador = User::find($request->input('coordinador'));
                    if($newCoordinador) {
                        $newCoordinador->id_role = Role::$ROLE_COORDINADORA_APOYO_TITULACION;
                        $newCoordinador->save();
                        // ahora se actualiza el jefe antiguo a maestro
                        if($request->input('coordinadorActual')) {
                            // si existe lo buscamos y le cambiamos el rol a maestro de nuevo
                            $coordinadorActual = User::find($request->input('coordinadorActual'));
                            if($coordinadorActual) {
                                $coordinadorActual->id_role = Role::$ROLE_SECRETARIA_DIVISION;
                                $coordinadorActual->save();
                            }
                        }
                        return redirect()->back()->with("success",
                            "Se ha actualizado la/el coordinador(a) con éxito: ");

                    }
                    return redirect()->back()->with("error",
                        $this->genericErrorMessage);
                }
            }
            return redirect()->back()->with("error", "Selecciona un elemento antes de guardar");
        }
        return redirect()->back();
    }

    public function asignarCoordinadoraApoyoTitulacionEdit() {
        $divisionEstudios = User::divisionEstudios()->get();
        $divisionRole = Role::find(Role::$ROLE_COORDINADORA_APOYO_TITULACION);
        return view('dashboards.administrador.cuentas.asignacion.coordinadorDivisionEstudios',
            compact('divisionEstudios', 'divisionRole'));
    }

    // rutas para la generacion de avisos

    /**
     * Para el manejo del metodo get en la formulación del aviso
     * @param $idAlumno
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function createAvisos($idAlumno) {
        $user = User::alumnoWithAsesoresfindByidAlumno($idAlumno)->first();
        $alumno = $user->alumno;

        $acta = $alumno["procesoTitulacion"]->acta;
        $presidente = Maestro::findOrFail($alumno["procesoTitulacion"]["asesores"]["id_presidente"])->user;
        $secretario = Maestro::findOrFail($alumno["procesoTitulacion"]["asesores"]["id_secretario"])->user;
        $vocal = Maestro::findOrFail($alumno["procesoTitulacion"]["asesores"]["id_vocal"])->user;
        $vocal_suplente = Maestro::findOrFail($alumno["procesoTitulacion"]["asesores"]["id_vocal_suplente"])->user;

        $proyecto = $user->alumno->proyecto;
        $carrera = $user->alumno->carrera;
        $academia = $carrera->especialidad->academia;

        return view('dashboards.secretariaDivision.secciones.avisoCreation',
                compact(
                    'user',
                    'alumno',
                    'presidente',
                    'secretario',
                    'vocal',
                    'vocal_suplente',
                    'proyecto',
                    'carrera',
                    'academia',
                    'acta'
                ));
    }

    /**
     * crear el acta para el determinado alumno
     * @param $idAlumno
     * @param  $idProcesoTitulacion
     */
    public function storeAvisos(AvisoRequest $request, $idAlumno, $idProcesoTitulacion) {
        $fecha = $request->input('fecha_examen_aviso');
        $horaInicio = $request->input('hora_inicio');
        $lugarProtocolo = $request->input('lugar_protocolo');

        $proceso = ProcesoTitulacion::find($idProcesoTitulacion);
        if($proceso) {

            // armando la fecha de generacion
            $fechaGeneracion = $this->formatDateHumanSpanish(Carbon::now()->timezone('America/Mexico_City'));

            // creamos una instancia de acta sin id_libro
            Acta::updateOrCreate(
                ['id_proceso_titulacion' => $idProcesoTitulacion],
                [
                'is_generated' => 0,
                'fecha_examen_aviso' => $fecha,
                'fecha_generacion' => $fechaGeneracion,
                'hora_inicio' => $horaInicio,
                'hora_fin' => null,
                'lugar_protocolo' => $lugarProtocolo,
                'id_libro' => null
            ]);

            // actualizando el estado del proceso de titulacion
            $proceso->avisos = true;
            $proceso->save();
            return redirect()->back()->with('success', 'Se ha guardado la fecha para el aviso con éxito');
        }
        return redirect()->back()->with('Error', 'No se guardar la fecha para el aviso');
    }

}
