<?php

namespace App\Http\Controllers;

use App\Role;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ServiciosEscolaresController extends Controller
{
    private $serviciosCreateSuccessMessage = 'Se ha creado con éxito el personal de servicios escolares, la contraseña '.
                        'de este es: *password*, debe ser cambiada en el primer acceso a la cuenta';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $serviciosEscolares = User::serviciosEscolares()->get();

        return view('dashboards.administrador.cuentas.listado.serviciosEscolares',
                compact('serviciosEscolares'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('dashboards.administrador.cuentas.creacion.serviciosEscolares');
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
        $serviciosEscolaresUser = User::create([
            'nombre' => $request->input('nombre'),
            'apellidos' => $request->input('apellidos'),
            'email' => $request->input('email'),
            'password' => Hash::make('password'),
            // activado: true
            'is_enable' => 1,
            // secretaria de division de estudios role
            'id_role' => 4
        ]);

        return redirect()->back()->with('success', $this->serviciosCreateSuccessMessage);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // inhabilitacion de los maestros
        $user = User::findOrFail($id);
        $role = $user->id_role;
        if($role == Role::$ROLE_SERVICIOS_ESCOLARES) {
            $user->is_enable = 0;
            $user->save();
            return redirect()->back()->with('success', 'Se ha desactivado al personal de servicios escolares con éxito');
        } else {
            return redirect()->back()->with('Error', 'No se ha podido desactivar al personal');
        }
    }

    public function actaSearch(Request $request) {
        //
        $num_control = $request->input('control');
        $alumno = User::findByNumeroControl($num_control)->first();
        if($alumno != null) {
            if($alumno["alumno"]["procesoTitulacion"]["avisos"]) {
                return view('dashboards.serviciosEscolares.actas.actaSearch',
                        compact('alumno'));
            }
        } else {
            return dd("No se pudo encontrar nada");
        }
    }

}
