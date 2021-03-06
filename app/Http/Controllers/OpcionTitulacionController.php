<?php

namespace App\Http\Controllers;

use App\Http\Requests\OpcionTitulacionRequest;
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
        $opciones = OpcionTitulacion::all();
        return view('dashboards.administrador.opcionTitulacion.visualizar',
            compact('opciones'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('dashboards.administrador.opcionTitulacion.crear');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(OpcionTitulacionRequest $request)
    {
        //
        $opcion = OpcionTitulacion::create([
            'clave' => $request->input('clave'),
            'nombre' => $request->input('nombre'),
            'estado' => true

        ]);
        return redirect('/OpcionTitulacion/create')
            ->with('success', 'Se ha creado la opción');
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
    public function edit($id)
    {
        //
        $opcion = OpcionTitulacion::findOrFail($id);
        return view('dashboards/administrador/opcionTitulacion/editar',
            compact('opcion')
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\OpcionTitulacion  $opcionTitulacion
     * @return \Illuminate\Http\Response
     */
    public function update(OpcionTitulacionRequest $request, $id)
    {
        try {
            $opcion = OpcionTitulacion::findOrFail($id);
            $opcion->nombre = $request->input('nombre');
            $opcion->clave = $request->input('clave');
            $opcion->save();

        } catch(\Exception $e) {
            return redirect()->back()->with('error', 'la opcion de titulación que deseas editar no existe.');
        }
        return redirect()->back()->with('success', 'Se ha actualizado con éxito');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\OpcionTitulacion  $opcionTitulacion
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $opcion = OpcionTitulacion::findOrFail($id);
        $opcion->estado = 0;
        $opcion->save();
        return redirect()->back()->with('success', 'Se ha desactivado un tipo de opcion de titulación con éxito');
    }
}
