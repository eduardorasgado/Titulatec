<?php

namespace App\Http\Controllers;

use App\Acta;
use App\Http\Requests\ActaRequest;
use App\Libro;
use App\User;
use Illuminate\Http\Request;

class ActaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $alumnos = User::withFullDEData()->get();
        $alumnosConActas = [];
        $alumnosSinActas = [];

        foreach ($alumnos as $alumno) {
            if(!$alumno["alumno"]["procesoTitulacion"]["is_proceso_finished"] && 
                $alumno["alumno"]["procesoTitulacion"]["avisos"]) {
                array_push($alumnosSinActas, $alumno);
            }
            if($alumno["alumno"]["procesoTitulacion"]["is_proceso_finished"]) {
                array_push($alumnosConActas, $alumno);
            }
        }

        return view('dashboards.serviciosEscolares.actas.home',
                compact('alumnosConActas', 'alumnosSinActas'));
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
     * @param  \App\Acta  $acta
     * @return \Illuminate\Http\Response
     */
    public function show($idActa)
    {
        try {
            $acta = Acta::findOrFail($idActa);
            $libros = Libro::all();

            return view('dashboards.serviciosEscolares.actas.show',
                    compact('acta', 'libros'));
        } catch(\Exception $e) {
            return redirect()->back()->with('Error', 'No se ha encontrado el acta deseada');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Acta  $acta
     * @return \Illuminate\Http\Response
     */
    public function edit(ActaRequest $request, $idActa)
    {
        try{
            $acta = Acta::findOrFail($idActa);
            $acta->id_libro = $request->input('id_libro');
            $acta->hora_fin = $request->input('hora_fin');
            $acta->save();

            // cambiando el estado del proceso para verificar que se han terminado todos los pasos y asi proceder a generar el acta
            $proceso = $acta->procesoTitulacion;
            $proceso->is_proceso_finished = true;
            $proceso->save();

            return redirect()->back()->with('success', 'Se han guardado los datos, puede generar el acta');
        } catch (\Exception $e) {
            return redirect()->back()->with('Error', 'No se ha encontrado el acta seleccionada');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Acta  $acta
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Acta $acta)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Acta  $acta
     * @return \Illuminate\Http\Response
     */
    public function destroy(Acta $acta)
    {
        //
    }
}
