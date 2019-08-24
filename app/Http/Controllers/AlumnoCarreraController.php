<?php

namespace App\Http\Controllers;

use App\AlumnoCarrera;
use App\Http\Requests\CarreraRequest;
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
        dd("se esta seteando con exito");
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
