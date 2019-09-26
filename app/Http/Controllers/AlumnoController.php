<?php

namespace App\Http\Controllers;

use App\Alumno;
use App\Especialidad;
use App\Http\Requests\AlumnoRequest;
use App\OpcionTitulacion;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AlumnoController extends Controller
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
     * @param  \App\Alumno  $alumno
     * @return \Illuminate\Http\Response
     */
    public function show(Alumno $alumno)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Alumno  $alumno
     * @return \Illuminate\Http\Response
     */
    public function edit(Alumno $alumno)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Alumno  $alumno
     * @return \Illuminate\Http\Response
     */
    public function update(AlumnoRequest $request, $id)
    {
        $alumno = Alumno::find($id);
        if($alumno) {
            $alumno->direccion = $request->input('direccion');
            $alumno->telefono = $request->input('telefono');
            $alumno->estado = $request->input('estado');
            $alumno->ciudad = $request->input('ciudad');
            $alumno->lugar_trabajo = $request->input('lugar_trabajo');
            $alumno->puesto_trabajo = $request->input('puesto_trabajo');

            $alumno->completed = true;
            // TODO: DESCOMENTAR PARA EVALUAR
            //$alumno->save();

            //return redirect()->back()
            //        ->with('success-alumno', 'Los datos han sido actualizados con éxito');
            $alumno = User::alumnoWithCarrera(Auth::user()->id)->first();
            $especialidades = Especialidad::all();
            $opcionesTitulacion = OpcionTitulacion::all();
            $procesoTitulacion = $alumno["alumno"]->procesoTitulacion;
            return view('dashboards.alumno.firstTimeProcess.datosEscolares',
                compact('alumno', 'especialidades', 'opcionesTitulacion',
                'procesoTitulacion'));
        }
        else {
            return redirect()->back()
                ->with('error-alumno', 'No existe el alumno');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Alumno  $alumno
     * @return \Illuminate\Http\Response
     */
    public function destroy(Alumno $alumno)
    {
        //
    }

    public function generateSolicitudTitulacion() {
        // creando proceso en base de dato

        dd("generando la solicitud de titulación");
    }
}
