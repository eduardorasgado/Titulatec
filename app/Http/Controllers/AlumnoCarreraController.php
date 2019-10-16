<?php

namespace App\Http\Controllers;

use App\Alumno;
use App\AlumnoCarrera;
use App\Http\Requests\CarreraRequest;
use App\ProcesoTitulacion;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AlumnoCarreraController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\AlumnoCarrera  $alumnoCarrera
     * @return \Illuminate\Http\Response
     */
    public function show(AlumnoCarrera $alumnoCarrera)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\AlumnoCarrera  $alumnoCarrera
     * @return \Illuminate\Http\Response
     */
    public function edit(AlumnoCarrera $alumnoCarrera)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\AlumnoCarrera  $alumnoCarrera
     * @return \Illuminate\Http\Response
     */
    public function update(CarreraRequest $request, $idAlumno)
    {

        $alumnoCarrera = AlumnoCarrera::getByIdAlumno($idAlumno);
        // guardando numero de control en alumno
        $alumno = Alumno::findOrFail($idAlumno);

        if($alumno != null) {
            $alumno->numero_control = $request->input('numero_control');
            $alumno->otherTECNM = $request->input('otherTECNM');
            $alumno->generacion = $request->input('generacion');
            $alumno->anexo = $request->input('anexo');
            $alumno->save();
            // guardando opcion de titulacion
            $proceso = ProcesoTitulacion::findByAlumnoId($idAlumno);
            $exits = false;
            if($proceso->count() > 0){
                $exits = true;
            }

            if(!$exits) {
                ProcesoTitulacion::create([
                    'datos_generales' => false,
                    'solicitud_titulacion' => false,
                    'memorandum' => false,
                    'registro_proyecto' => false,
                    'avisos' => false,
                    'is_proceso_finished' => false,
                    'id_alumno' => $idAlumno,
                    'id_opcion_titulacion' => $request->input('opcion')
                ]);
            } else {
                $proceso = $proceso->first();
                $proceso->id_opcion_titulacion = $request->input('opcion');

                $proceso->save();
            }
            // guardando datos de carrera
            $alumnoCarrera->id_especialidad = $request->input('especialidad');

            // el siguiente campo viene con un json de tipo {id:%, is_actual:%}
            $obj = $request->input('plan');
            // es necesario poner comillas dobles para cada miembro del json para hacer el decode
            $obj = str_replace("'", "\"", $obj);
            $alumnoCarrera->id_plan_estudios = json_decode($obj)->id;


            $alumnoCarrera->save();
            //return redirect()->back()->with('success-especialidad', 'Actualización exitosa');
            // redireccionando hacia la importacion o creacion del proceso

            $alumno = User::alumnoWithCarrera(Auth::user()->id)->first();

            return view('dashboards.alumno.firstTimeProcess.datosProfesionales',
                compact('idAlumno', 'alumno'));

        } else {
            return redirect()->back()->with('error-especialidad', 'Error, intente más tarde');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\AlumnoCarrera  $alumnoCarrera
     * @return \Illuminate\Http\Response
     */
    public function destroy(AlumnoCarrera $alumnoCarrera)
    {
        //
    }
}
