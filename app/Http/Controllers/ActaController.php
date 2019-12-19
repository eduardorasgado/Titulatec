<?php

namespace App\Http\Controllers;

use App\Acta;
use App\Http\Requests\ActaRequest;
use App\Libro;
use App\Maestro;
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
        $alumnosConActas = User::withActasComplete()
            ->orderBy('id', 'desc')
            ->paginate(6, ['*'], 'set1');
        $alumnosSinActas = User::withActasNonComplete()
            ->orderBy('id', 'asc')
            ->paginate(6, ['*'], 'set2');

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
            $first_save = $acta->id_libro;
            $acta->id_libro = $request->input('id_libro');
            $acta->hora_fin = $request->input('hora_fin');
            $acta->foja = $request->input('foja');

            $acta->save();

            // cambiando el estado del proceso para verificar que se han terminado todos los pasos y asi proceder a generar el acta
            $proceso = $acta->procesoTitulacion;
            $proceso->is_proceso_finished = true;
            $proceso->save();

            /*
            encontrar alumno y asesores
            quitarle a todos los asesores el conteo de asesorias -1
            Nota: para quitar a los asesores debemos comprobar que es la primera vez que se guardan los datos
            id_libro, hora_fin y foja, para eso usamos la variable first_save
            */
            if($first_save == null) {
                $asesores = $acta->procesoTitulacion->asesores;

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
            }

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
