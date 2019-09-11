<?php

namespace App\Http\Controllers;

use App\Alumno;
use App\Especialidad;
use App\Http\Requests\DefaultPassRequest;
use App\OpcionTitulacion;
use App\Proyecto;
use App\Role;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

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

        if($this->checkDefaultPassword()){
            return view('auth.passwords.firstSession');
        }

        if(Auth::user()->id_role == Role::$ROLE_ADMIN) {
            // devuelve el dashboard del administrador
            //return dd(Auth::user()->role->id);
            return view('dashboards.administrador.home',
                compact('role'));
        }

        else if(Auth::user()->id_role == Role::$ROLE_JEFE_ACADEMIA
            || Auth::user()->id_role == Role::$ROLE_MAESTRO) {
            // dashboard de jefe de academia
            // dashboard de maestro
            $roleJefeAcademia = Role::$ROLE_JEFE_ACADEMIA;
            return view('dashboards.jefeAcademia.home',
                compact('role', 'roleJefeAcademia'));
        }
        else if(Auth::user()->id_role == Role::$ROLE_SECRETARIA_DIVISION
            || Auth::user()->id_role == Role::$ROLE_JEFE_DIVISION
            || Auth::user()->id_role == Role::$ROLE_COORDINADORA_APOYO_TITULACION) {
            // dashboard de secretaria de division de estudios
            // dashboard de jefe de division de estudios
            return view('dashboards.secretariaDivision.home',
                    compact('role'));
        }
        else if(Auth::user()->id_role == Role::$ROLE_SERVICIOS_ESCOLARES) {
            // dashboard de servicios escolares
            return view('dashboards.serviciosEscolares.home',
                compact('role'));
        }
        else if(Auth::user()->id_role == Role::$ROLE_ALUMNO) {
            // dashboard de alumno, si existe alumno traelo, si existe carrera, traerlo
            return $this->alumnoHome($role);
        }
        else {
            return redirect('/');
        }
    }

    private function alumnoHome($role) {
        $alumno = User::alumnoWithCarrera(Auth::user()->id)->first();
        $especialidades = Especialidad::all();
        $proyecto = Proyecto::find($alumno["alumno"]["id_proyecto"]);
        $opcionesTitulacion = OpcionTitulacion::all();
        $procesoTitulacion = $alumno["alumno"]->procesoTitulacion;
        $registroCompletado = false;

        if($proyecto != null && $alumno["alumno"]->completed && $alumno["alumno"]["carrera"]["id_plan_estudios"] != null &&
            $procesoTitulacion != null) {
            $registroCompletado = true;
            if(!$procesoTitulacion->datos_generales) {
                $procesoTitulacion->datos_generales = true;
                $procesoTitulacion->save();
            }
        }
        //return dd($alumno);
        return view('dashboards.alumno.home',
            compact('role', 'alumno', 'especialidades',
                'proyecto', 'registroCompletado', 'opcionesTitulacion',
                'procesoTitulacion'));
    }

    public function passwordUpdate(DefaultPassRequest $request) {

        $userLogged = User::find(Auth::user()->id);
        // creando una nueva contrasena
        $userLogged->password = Hash::make($request->input('password'));
        $userLogged->save();
        return redirect('/home');
    }

    // UTILIDADES DEL CONTROLLER
    /**
     * Este metodo comprueba que la contrasena de el usuario sea distinta de default
     */
    private function checkDefaultPassword() {
        return Hash::check('password', Auth::user()->getAuthPassword());
    }
}
