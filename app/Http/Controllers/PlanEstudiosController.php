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
        $especialidades = Especialidad::all();
        return view('dashboards/administrador/planEstudios/editar',
            compact('plan', 'especialidades')
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\PlanEstudios  $planEstudios
     * @return \Illuminate\Http\Response
     */
    public function update(PlanEstudioRequest $request, $id)
    {
        try {
            $plan = PlanEstudios::findOrFail($id);
            $plan->nombre = $request->input('nombre');
            $plan->id_academia = $request->input('academia');

            $plan->save();

        } catch(\Exception $e) {
            return redirect()->back()->with('error', 'El plan de estudios que deseas editar no existe.');
        }
        return redirect()->back()->with('success', 'Se ha actualizado con éxito');
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
        $plan->estado = 0;
        $plan->save();
        return redirect()->back()->with('success', 'Se ha desactivado un plan de estudios con éxito');
    }

    public function getAllByEspecialidad($idEspecialidad) {
        // checamos que exista la especialidad
        $planes = [];
        if(Especialidad::find($idEspecialidad)) {
             $planes = PlanEstudios::getAllByEspecialidad($idEspecialidad)->get();
        }
        return response()
            ->json(['planes' => $planes]);
    }
}
