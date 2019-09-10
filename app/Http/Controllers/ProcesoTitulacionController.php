<?php

namespace App\Http\Controllers;

use App\ProcesoTitulacion;
use Illuminate\Http\Request;

class ProcesoTitulacionController extends Controller
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
        $alumnoId = $request->input('idAlumno');
        if($alumnoId) {
            $proceso = ProcesoTitulacion::findByAlumnoId($alumnoId);
            $exits = false;
            if($proceso->count() > 0){
                $exits = true;
            }
            if(!$exits) {
                ProcesoTitulacion::create([
                    'datos_generales' => false,
                    'solicitud_titulacion' => false,
                    'memorandum' => false,
                    'registro_proyecto' => false,
                    'avisos' => false,
                    'is_proceso_finished' => false,
                    'id_alumno' => $alumnoId,
                    'id_opcion_titulacion' => $request->input('opcion')
                ]);
            } else {
                $proceso = $proceso->first();
                $proceso->id_opcion_titulacion = $request->input('opcion');
                $proceso->save();
            }
            return redirect()->back()->with('success-opcion', 'Se ha guardado la opción de titulación');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ProcesoTitulacion  $procesoTitulacion
     * @return \Illuminate\Http\Response
     */
    public function show(ProcesoTitulacion $procesoTitulacion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ProcesoTitulacion  $procesoTitulacion
     * @return \Illuminate\Http\Response
     */
    public function edit(ProcesoTitulacion $procesoTitulacion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ProcesoTitulacion  $procesoTitulacion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProcesoTitulacion $procesoTitulacion)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ProcesoTitulacion  $procesoTitulacion
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProcesoTitulacion $procesoTitulacion)
    {
        //
    }
}
