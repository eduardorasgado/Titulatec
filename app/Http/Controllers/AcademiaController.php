<?php

namespace App\Http\Controllers;

use App\Academia;
use App\Http\Requests\NameRequest;
use App\OpcionTitulacion;
use Illuminate\Http\Request;

class AcademiaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $academias = Academia::all();
        return view('dashboards.administrador.academias.visualizar',
            compact('academias'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('dashboards.administrador.academias.crear');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(NameRequest $request)
    {
        $academia = Academia::create([
            'nombre' => $request->input('nombre'),
            'estado' => true
        ]);

        return redirect('/Academia/create')
            ->with('success', 'Se ha creado una academia con éxito');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Academia  $academia
     * @return \Illuminate\Http\Response
     */
    public function show(Academia $academia)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Academia  $academia
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $academia = Academia::findOrFail($id);
        $academia = Academia::findOrFail($id);
        return view('dashboards/administrador/academias/editar',
            compact('academia')
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Academia  $academia
     * @return \Illuminate\Http\Response
     */
    public function update(NameRequest $request, $id)
    {
        try {
            $academia = Academia::findOrFail($id);
            $academia->nombre = $request->input('nombre');

            $academia->save();

        } catch(\Exception $e) {
            return redirect()->back()->with('error', 'la opcion de titulación que deseas editar no existe.');
        }
        return redirect()->back()->with('success', 'Se ha actualizado con éxito');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Academia  $academia
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $academia = Academia::findOrFail($id);
        $academia->estado = 0;
        $academia->save();
        return redirect()->back()->with('success', 'Se ha desactivado una academia con éxito');
    }
}
