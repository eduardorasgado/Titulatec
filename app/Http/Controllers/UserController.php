<?php

namespace App\Http\Controllers;

use App\Http\Requests\PassRequest;
use App\Http\Requests\UserRequest;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // metodo para enviar el formulario para la actualizacion de un user
    public function edit() {
        $userId = Auth::user()->id;
        try {
            $user = User::findOrFail($userId);

            return view('dashboards.administrador.cuentas.userUpdate',
                compact('user'));

        } catch (\Exception $e) {
            return redirect()->back()->with('Error', 'No se encuentra el usuario que desea editar');
        }
    }

    // metodo para guardar con metodo post los datos de un usuario
    public function update(UserRequest $request, $id) {

        // confirmamos la contrasena del usuario
        $correctPass = $this->updatePasswordCheck($request);
        if($correctPass) {
            $userLogged = $this->getUserLogged($request);
            // ahora cambiamos la contrasena en caso de que venga la contraseña nueva
            if($request->input('password') != null) {
                $newPass = Hash::make($request->input('password'));
                $userLogged = $this->savingCustomPassword($newPass, $userLogged);
                if(!$userLogged) {
                    return redirect()->back()->with('Error', 'No fue posible cambiar la contraseña por problemas internos');
                }
            }
            // procedemos a cambiar nombre y apellidos
            $userLogged->nombre = $request->input('nombre');
            $userLogged->apellidos = $request->input('apellidos');
            $userLogged->save();
            return redirect()->back()->with('success', 'Se han actualizado los datos del usuario');
        } else {
            return redirect()->back()->with('Error', 'La contraseña actual no coincide');
        }
    }

    public function getUserLogged($request) {
        $userLogged = User::find(Auth::user()->id);
        return $userLogged;
    }

    public function updatePasswordCheck($request) {
        // primero comparamos si la antigua es igual a la almacenada
        if(Hash::check($request->input('actual_password'), Auth::user()->getAuthPassword())) {
            return true;
        } else {
            return false;
        }
    }

    private function savingCustomPassword($newPass, $userLogged) {
        try {
            // creando una nueva contrasena
            $userLogged->password = $newPass;
            $userLogged->save();
            return $userLogged;

        } catch(\Exception $e) {
            return false;
        }
    }
}
