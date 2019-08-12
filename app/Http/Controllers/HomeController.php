<?php

namespace App\Http\Controllers;

use App\Role;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        if(Auth::user()->id_role == 1) {
            // devuelve el dashboard del administrador
            //return dd(Auth::user()->role->id);

            return view('home');
        }

        else if(Auth::user()->id_role == 2) {
            // dashboard de jefe de academia
        }
        else if(Auth::user()->id_role == 3) {
            // dashboard de secretaria de division de estudios
        }
        else if(Auth::user()->id_role == 4) {
            // dashboard de servicios escolares
        }
        else if(Auth::user()->id_role == 5) {
            // dashboard de maestro
        }
        else if(Auth::user()->id_role == 6) {
            // dashboard de alumno
        }
        /*
        else {
            $role1 = Role::find(1);

            $users = $role1->users;
            $us = '';

            foreach ($users as $user) {
                $us = $user->nombre.", ";
            }

            return view('home');
            return dd($us);
        }
        */
        else {
            return redirect('/');
        }
    }

    public function admin() {
        return var_dump('es un administrador');
    }
}
