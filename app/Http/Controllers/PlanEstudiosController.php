<?php

namespace App\Http\Controllers;

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
        return dd('form para crear un plan de estudio');
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
