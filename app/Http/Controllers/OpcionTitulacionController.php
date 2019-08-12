<?php

namespace App\Http\Controllers;

use App\OpcionTitulacion;
use Illuminate\Http\Request;

class OpcionTitulacionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return dd("index de opcion de titulacion");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return dd('Creando opcion de titulacion');
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
     * @param  \App\OpcionTitulacion  $opcionTitulacion
     * @return \Illuminate\Http\Response
     */
    public function show(OpcionTitulacion $opcionTitulacion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\OpcionTitulacion  $opcionTitulacion
     * @return \Illuminate\Http\Response
     */
    public function edit(OpcionTitulacion $opcionTitulacion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\OpcionTitulacion  $opcionTitulacion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, OpcionTitulacion $opcionTitulacion)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\OpcionTitulacion  $opcionTitulacion
     * @return \Illuminate\Http\Response
     */
    public function destroy(OpcionTitulacion $opcionTitulacion)
    {
        //
    }
}
