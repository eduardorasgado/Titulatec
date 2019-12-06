<?php

namespace App\Http\Controllers;

use App\Academia;
use App\Especialidad;
use App\Http\Requests\EspecialidadRequest;
use App\PlanEstudios;
use Illuminate\Http\Request;

class EspecialidadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $especialidades = Especialidad::all();
        return view('dashboards.administrador.especialidades.visualizar',
            compact('especialidades'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // mandamos las academias
        $academias = Academia::all();
        return view('dashboards.administrador.especialidades.crear',
                compact('academias'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EspecialidadRequest $request)
    {
        //
        $especialidad = Especialidad::create([
            'nombre' => $request->input('nombre'),
            'id_academia' => $request->input('academia'),
            'estado' => true,
        ]);

        return redirect('/Especialidad/create')
            ->with('success', 'Se ha creado una especialidad con éxito');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Especialidad  $especialidad
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Especialidad  $especialidad
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // se muestran todas las academmias
        $especialidad = Especialidad::findOrFail($id);
        $academias = Academia::all();
        return view('dashboards/administrador/especialidades/editar',
            compact('especialidad', 'academias')
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Especialidad  $especialidad
     * @return \Illuminate\Http\Response
     */
    public function update(EspecialidadRequest $request, $id)
    {
        try {
            $especialidad = Especialidad::findOrFail($id);
            $especialidad->nombre = $request->input('nombre');
            $especialidad->id_academia = $request->input('academia');

            $especialidad->save();

        } catch(\Exception $e) {
            return redirect()->back()->with('error', 'la especialidad que deseas editar no existe.');
        }
        return redirect()->back()->with('success', 'Se ha actualizado con éxito');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Especialidad  $especialidad
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $especialidad = Especialidad::findOrFail($id);
        $especialidad->estado = 0;
        $especialidad->save();
        return redirect()->back()->with('success', 'Se ha desactivado una especialidad con éxito');
    }
}
