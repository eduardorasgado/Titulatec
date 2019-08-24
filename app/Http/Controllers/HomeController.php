<?php

namespace App\Http\Controllers;

use App\Especialidad;
use App\Http\Requests\DefaultPassRequest;
use App\Role;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    private $defaultPass = '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi';
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

        if($this->checkDefaultPassword()){
            return view('auth.passwords.firstSession');
        }

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
            // dashboard de alumno, si existe alumno traelo, si existe carrera, traerlo
            $alumno = User::alumnoWithCarrera(Auth::user()->id)->first();
            $especialidades = Especialidad::all();
            //return dd($alumno);
            return view('dashboards.alumno.home',
                compact('role', 'alumno', 'especialidades'));
        }
        else {
            return redirect('/');
        }
    }

    public function passwordUpdate(DefaultPassRequest $request) {

        $userLogged = User::find(Auth::user()->id);
        $userLogged->password = bcrypt($request->input('password'));
        $userLogged->save();
        return redirect('/home');


    }

    // UTILIDADES DEL CONTROLLER
    /**
     * Este metodo comprueba que la contrasena de el usuario sea distinta de default
     */
    private function checkDefaultPassword() {
        return ($this->defaultPass == Auth::user()->getAuthPassword());
    }
}
