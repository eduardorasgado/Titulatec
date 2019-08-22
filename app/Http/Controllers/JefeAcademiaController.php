<?php

namespace App\Http\Controllers;

use App\Academia;
use App\Role;
use App\User;
use Illuminate\Http\Request;

class JefeAcademiaController extends Controller
{
    public function index() {
        // devolvemos a todos los jefes y a todos los maestros
        $jefes = User::with('maestro.academia')
            ->get()->where('id_role', Role::$ROLE_JEFE_ACADEMIA);
        $maestros = User::with('maestro.academia')
            ->get()->where('id_role', Role::$ROLE_MAESTRO);
        $academias = Academia::all();
        return view('dashboards.administrador.cuentas.asignacion.jefeAcademia',
            compact('jefes', 'maestros', 'academias'));
    }
    //
    public function update(Request $request, $academia) {
        dd("asignando al jefe de academia: ".$academia);
    }
}
