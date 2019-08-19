<?php

namespace App\Http\Controllers;

use App\Http\Requests\MaestroRequest;
use App\Maestro;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class MaestroController extends Controller
{

    private $maestroSuccessMessage = 'Se ha creado la cuenta de maestro, con éxito, la contraseña por defecto es '.
                            '*password*, el usuario deberá de cambiar esta contraseña la primera vez que entre al sistema';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $maestros = User::all()->where('id_role', '=', 5);

        return view('dashboards.administrador.cuentas.listado.maestro',
            compact('maestros'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('dashboards.administrador.cuentas.creacion.maestro');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MaestroRequest $request)
    {
        //
        $maestroUser = User::create([
            'nombre' => $request->input('nombre'),
            'apellidos' => $request->input('apellidos'),
            'email' => $request->input('email'),
            'password' => Hash::make('password'),
            // activado: true
            'is_enable' => 1,
            'id_role' => 5
        ]);

        return redirect('/Maestro/create')->with('success', $this->maestroSuccessMessage);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Maestro  $maestro
     * @return \Illuminate\Http\Response
     */
    public function show(Maestro $maestro)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Maestro  $maestro
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        return dd('mostrando form para editar maestro existente con id: '.$id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Maestro  $maestro
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Maestro $maestro)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Maestro  $maestro
     * @return \Illuminate\Http\Response
     */
    public function destroy(Maestro $maestro)
    {
        //
    }
}
