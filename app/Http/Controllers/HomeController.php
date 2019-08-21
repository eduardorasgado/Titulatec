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
        //  REDIRECCIONAMIENTO A DASHBOARD DADO EL TIPO DE USUARIO LOGUEADO

        $role = Auth::user()->role;

        if(Auth::user()->id_role == 1) {
            // devuelve el dashboard del administrador
            //return dd(Auth::user()->role->id);
            return view('dashboards.administrador.home',
                compact('role'));
        }

        else if(Auth::user()->id_role == 2 || Auth::user()->id_role == 5) {
            // dashboard de jefe de academia
            // dashboard de maestro
            return view('dashboards.jefeAcademia.home',
                compact('role'));
        }
        else if(Auth::user()->id_role == 3 || Auth::user()->id_role == 7) {
            // dashboard de secretaria de division de estudios
            // dashboard de jefe de division de estudios
            return view('dashboards.secretariaDivision.home',
                compact('role'));
        }
        else if(Auth::user()->id_role == 4) {
            // dashboard de servicios escolares
            return view('dashboards.serviciosEscolares.home',
                compact('role'));
        }
        else if(Auth::user()->id_role == 6) {
            // dashboard de alumno
            $alumno = User::find(Auth::user()->id)->alumno;
            //return dd($alumno);
            return view('dashboards.alumno.home',
                compact('role', 'alumno'));
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
