<?php

namespace App\Http\Controllers;

use App\Alumno;
use App\Http\Requests\ProyectoRequest;
use App\Proyecto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProyectoController extends Controller
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
        return view('proyecto.crear');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProyectoRequest $request)
    {
        // generando codigo
        $passed = false;
        while(! $passed) {
            $code = $this->generateCode();
            if(!Proyecto::where("codigo_compartido", "=", $code)->first()) {
                $passed = true;
            }
        }

        $alumnoId = Auth::user()->alumno->id;

        $proyecto = Proyecto::create([
            'nombre' => $request->input('nombre'),
            'producto' => $request->input('producto'),
            'num_total_integrantes' => $request->input('num_total_integrantes'),
            'conteo_registrados' => 1,
            'codigo_compartido' => $code,
            'id_creador' => $alumnoId,
            'is_closed' => false
        ]);

        // guardando el id del proyecto dentro del alumno
        $alumno = Alumno::find($alumnoId);
        if($alumno) {
            $alumno->id_proyecto = $proyecto->id;
            $alumno->save();
        }

        return redirect()->back()->with('success', 'Proyecto creado, regrese a su dashboard para verificar');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Proyecto  $proyecto
     * @return \Illuminate\Http\Response
     */
    public function show(Proyecto $proyecto)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Proyecto  $proyecto
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $proyecto = Proyecto::find($id);
        return view('proyecto.editar',
                compact('proyecto'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Proyecto  $proyecto
     * @return \Illuminate\Http\Response
     */
    public function update(ProyectoRequest $request, $id)
    {
        $proyecto = Proyecto::find($id);

        $proyecto->nombre = $request->input('nombre');
        $proyecto->producto = $request->input('producto');
        $proyecto->num_total_integrantes = $request->input('num_total_integrantes');

        $proyecto->save();

        return redirect()->back()->with('success', 'Se ha actualizado con éxito el proyecto');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Proyecto  $proyecto
     * @return \Illuminate\Http\Response
     */
    public function destroy(Proyecto $proyecto)
    {
        //
    }

    public function generateCode() {
        return $this->getToken(20);
    }

    // UITLIDADES

    public function getToken($length){
        $token = "";
        $codeAlphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $codeAlphabet.= "abcdefghijklmnopqrstuvwxyz";
        $codeAlphabet.= "0123456789";
        $max = strlen($codeAlphabet); // edited

        for ($i=0; $i < $length; $i++) {
            $token .= $codeAlphabet[random_int(0, $max-1)];
        }

        return $token;
    }
}
