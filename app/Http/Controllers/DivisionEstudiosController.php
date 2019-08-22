<?php

namespace App\Http\Controllers;

use App\Http\Requests\PersonalDepartamentoRequest;
use App\Role;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class DivisionEstudiosController extends Controller
{
    private $divisionCreateSuccessMessage = 'Se ha creado correctamente el personal de division de estudios, puede'.
                ' ya accesar al sistema con la contraseña *password* que debe cambiar en su primera sesión';

    private $genericErrorMessage = 'Ocurrió un error al intentar actualizar el jefe, intente más tarde';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        //
        $divisionEstudios = User::divisionEstudios()->get();
        $roleJefe = Role::$ROLE_JEFE_DIVISION;

        return view('dashboards.administrador.cuentas.listado.divisionEstudios',
            compact('divisionEstudios', 'roleJefe'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('dashboards.administrador.cuentas.creacion.divisionEstudios');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PersonalDepartamentoRequest $request)
    {
        //
        $divisionEstudiosUser = User::create([
            'nombre' => $request->input('nombre'),
            'apellidos' => $request->input('apellidos'),
            'email' => $request->input('email'),
            'password' => Hash::make('password'),
            // activado: true
            'is_enable' => 1,
            // secretaria de division de estudios role
            'id_role' => 3
        ]);

        return redirect()->back()->with('success', $this->divisionCreateSuccessMessage);
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
        //
    }

    // custom funtions

    /**
     * Muestra el formulario para asignar al jefe
     */
    public function asignarJefeEdit() {
        $divisionEstudios = User::divisionEstudios()->get();
        $divisionRole = Role::find(Role::$ROLE_JEFE_DIVISION);
        return view('dashboards.administrador.cuentas.asignacion.jefeDivisionEstudios',
                compact('divisionEstudios', 'divisionRole'));
    }

    public function asignarJefeUpdate(Request $request) {
        // asignamos el nuevo jefe
        if($request->input('jefe')) {
            if(!empty($request->input('jefe'))) {
                $newJefe = User::find($request->input('jefe'));
                if($newJefe) {
                    $newJefe->id_role = Role::$ROLE_JEFE_DIVISION;
                    $newJefe->save();
                    // ahora se actualiza el jefe antiguo a maestro
                    if($request->input('jefeActual')) {
                        // si existe lo buscamos y le cambiamos el rol a maestro de nuevo
                        $jefeActual = User::find($request->input('jefeActual'));
                        if($jefeActual) {
                            $jefeActual->id_role = Role::$ROLE_SECRETARIA_DIVISION;
                            $jefeActual->save();
                        }
                    }
                    return redirect()->back()->with("success",
                        "Se ha actualizado el jefe con éxito: ");

                }
                return redirect()->back()->with("error",
                    $this->genericErrorMessage);
            }
        }
        return redirect()->back()->with("error", "Selecciona un elemento antes de guardar");

    }
}
