<?php

namespace App\Http\Controllers;

use App\Especialidad;
use App\Http\Requests\PlanEstudioRequest;
use App\PlanEstudios;
use Illuminate\Http\Request;

class PlanEstudiosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        //
        $planes = PlanEstudios::all();
        return view('dashboards.administrador.planEstudios.visualizar',
            compact('planes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // devolvemos las especialidades
        $especialidades = Especialidad::all();
        return view('dashboards.administrador.planEstudios.crear',
            compact('especialidades'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PlanEstudioRequest $request)
    {
        $planEstudio = PlanEstudios::create([
            'clave' => $request->input('clave'),
            'is_actual' => $request->input('is_actual'),
            'estado' => true,
            'id_especialidad' => $request->input('especialidad')
        ]);
        if($planEstudio != null) {
            return redirect()->back()->with('success', 'Se ha agregado un plan de estudio');
        } else {
            redirect()->back()->with('error', 'No pudo ser agregado un plan de estudio');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\PlanEstudios  $planEstudios
     * @return \Illuminate\Http\Response
     */
    public function show(PlanEstudios $planEstudios)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\PlanEstudios  $planEstudios
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $plan = PlanEstudios::findOrFail($id);
        return dd('El plan de estudios a modificar es: '.$plan->clave);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\PlanEstudios  $planEstudios
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PlanEstudios $planEstudios)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\PlanEstudios  $planEstudios
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $plan = PlanEstudios::findOrFail($id);
        return dd('Se desactivó un plan de estudios permanentemente: '.$plan->clave);
    }
}
