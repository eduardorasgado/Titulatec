<?php

namespace App\Http\Controllers;

use App\Academia;
use App\Http\Requests\JefeAcademiaRequest;
use App\Http\Requests\MaestroRequest;
use App\Maestro;
use App\Role;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class MaestroController extends Controller
{

    public $maestroSuccessMessage = 'Se ha creado la cuenta de maestro, con éxito, la contraseña por defecto es '.
                            '*password*, el usuario deberá de cambiar esta contraseña la primera vez que entre al sistema';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // todos los maestros y jefes de academia con sus entidades de maestro y estas a la vez con sus entidades de academia
        $maestros = User::jefesAndMaestrosWithAcademia()->get();

        $academias = Academia::all();
        $roleJefe = Role::$ROLE_JEFE_ACADEMIA;

        return view('dashboards.administrador.cuentas.listado.maestro',
            compact('maestros', 'academias', 'roleJefe'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $academias = Academia::all();
        return view('dashboards.administrador.cuentas.creacion.maestro',
            compact('academias'));
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
         try {
             $this->storeNewMaestro($request);
             return redirect()->back()->with('success', $this->maestroSuccessMessage);

         } catch (\Exception $e) {
             return redirect()->back()->with('Error', 'Error al intentar crear un maestro');
         }
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
        try {
            $maestro = Maestro::findOrFail($id);
            $academias = Academia::all();
            return view('dashboards.jefeAcademia.actualizacion.editar',
            compact('maestro', 'academias'));
        } catch (\Exception $e) {
            return redirect()->back()->with('Error', 'No existe el id del maestro que deseas editar');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Maestro  $maestro
     * @return \Illuminate\Http\Response
     */
    public function update(JefeAcademiaRequest $request, $maestroId)
    {
        // comprobamos la pasword del usuario en cuestion
        // una vez comprobado procedemos a actualizar los datos
        return dd($maestroId);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Maestro  $maestro
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // inhabilitacion de los maestros
        $user = User::findOrFail($id);
        $role = $user->id_role;
        if($role == Role::$ROLE_JEFE_ACADEMIA) {
            return redirect()->back()->with('Error', 'No se ha podido desactivar al maestro porque es jefe de academia, cambie de jefe de academia previo a esta acción');
        } else {
            $user->is_enable = 0;
            $user->save();
            return redirect()->back()->with('success', 'Se ha desactivado un maestro con éxito');
        }
    }

    public function storeNewMaestro(MaestroRequest $request) {
        $maestroUser = User::create([
            'nombre' => $request->input('nombre'),
            'apellidos' => $request->input('apellidos'),
            'email' => $request->input('email'),
            'password' => Hash::make('password'),
            // activado: true
            'is_enable' => 1,
            'id_role' => 5
        ]);

        $maestro = Maestro::create([
            'id_user' => $maestroUser->id,
            'cedula_profesional' => $request->input('cedula_profesional'),
            'especialidad_estudiada' => $request->input('especialidad_estudiada'),
            'id_academia' => $request->input('academia'),
            'asesor_count' => 0,
        ]);
    }
}
