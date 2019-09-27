<?php

namespace App\Http\Controllers;

use App\Alumno;
use App\AlumnoCarrera;
use App\Http\Requests\CarreraRequest;
use App\ProcesoTitulacion;
use Illuminate\Http\Request;

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
                //$proceso = $proceso->first();
                //$proceso->id_opcion_titulacion = $request->input('opcion');

                $proceso->save();
            }
            // guardando datos de carrera
            $alumnoCarrera->id_especialidad = $request->input('especialidad');
            $alumnoCarrera->id_plan_estudios = $request->input('plan');

            $alumnoCarrera->save();
            //return redirect()->back()->with('success-especialidad', 'Actualización exitosa');
            // redireccionando hacia la importacion o creacion del proceso
            return view('dashboards.alumno.firstTimeProcess.proyecto',
                compact('idAlumno'));

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
