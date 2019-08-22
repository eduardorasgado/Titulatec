<?php

namespace App\Http\Controllers;

use App\Academia;
use App\Role;
use App\User;
use Illuminate\Http\Request;

class JefeAcademiaController extends Controller
{
    private $genericErrorMessage = "Ha existido un error al intentar agregar un nuevo jefe de academia";
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

        // asignamos el nuevo jefe
        if($request->input('jefe')) {
            if(!empty($request->input('jefe'))) {
                $newJefe = User::find($request->input('jefe'));
                if($newJefe) {
                    $academiaDelJefe = $newJefe->maestro->academia;
                    if($academiaDelJefe->id == $academia) {
                        $newJefe->id_role = Role::$ROLE_JEFE_ACADEMIA;
                        $newJefe->save();

                        // ahora se actualiza el jefe antiguo a maestro
                        if($request->input('jefeActual')) {
                            // si existe lo buscamos y le cambiamos el rol a maestro de nuevo
                            $jefeActual = User::find($request->input('jefeActual'));
                            if($jefeActual) {
                                $jefeActual->id_role = Role::$ROLE_MAESTRO;
                                $jefeActual->save();
                            }
                        }
                        return redirect()->back()->with("success",
                            "Se ha actualizado el jefe con éxito: ".$academiaDelJefe->nombre);
                    }
                }
                return redirect()->back()->with("error",
                    $this->genericErrorMessage);
            }
        }
        return redirect()->back()->with("error", "Selecciona un elemento antes de guardar");
    }
}
