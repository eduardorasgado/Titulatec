<?php

namespace App\Http\Controllers;

use App\Academia;
use App\Acta;
use App\Alumno;
use App\Especialidad;
use App\Http\Requests\DefaultPassRequest;
use App\Http\Requests\PassRequest;
use App\Maestro;
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
        // middleware que previene que el sistema entre a home cuando se ha deslogueado
        $this->middleware('preventBackHistory');
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
            return $this->maestroAndJefeAcademiaHome($role);
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
            $academias = Academia::all();

            // consiguiendo todas las actas por mes
            $enero = '04';
            $actas_enero = Acta::whereRaw('MONTH(created_at) = '.$enero)->get();
            $febrero = '04';
            $actas_febrero = Acta::whereRaw('MONTH(created_at) = '.$febrero)->get();
            $marzo = '04';
            $actas_marzo = Acta::whereRaw('MONTH(created_at) = '.$marzo)->get();
            $abril = '04';
            $actas_abril = Acta::whereRaw('MONTH(created_at) = '.$abril)->get();
            $mayo = '05';
            $actas_mayo = Acta::whereRaw('MONTH(created_at) = '.$mayo)->get();
            $junio = '06';
            $actas_junio = Acta::whereRaw('MONTH(created_at) = '.$junio)->get();
            $julio = '07';
            $actas_julio = Acta::whereRaw('MONTH(created_at) = '.$julio)->get();
            $agosto = '08';
            $actas_agosto = Acta::whereRaw('MONTH(created_at) = '.$agosto)->get();
            $septiembre = '09';
            $actas_septiembre = Acta::whereRaw('MONTH(created_at) = '.$septiembre)->get();
            $octubre = '10';
            $actas_octubre = Acta::whereRaw('MONTH(created_at) = '.$octubre)->get();
            $noviembre = '11';
            $actas_noviembre = Acta::whereRaw('MONTH(created_at) = '.$noviembre)->get();
            $diciembre = '12';
            $actas_diciembre = Acta::whereRaw('MONTH(created_at) = '.$diciembre)->get();

            return view('dashboards.serviciosEscolares.home',
                compact('role', 'academias',
                'actas_enero',
                'actas_febrero',
                'actas_marzo',
                'actas_abril',
                'actas_mayo',
                'actas_junio',
                'actas_julio',
                'actas_agosto',
                'actas_septiembre',
                'actas_octubre',
                'actas_noviembre',
                'actas_diciembre'));
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

        if($proyecto == null) {
            // en caso de ser la primera vez que entra al sistema
            return view('dashboards.alumno.firstTimeProcess.datosPersonales',
                compact('role', 'alumno', 'especialidades',
                    'proyecto', 'registroCompletado', 'opcionesTitulacion',
                    'procesoTitulacion'));
        } else {
            //return dd($alumno);
            return view('dashboards.alumno.home',
                compact('role', 'alumno', 'especialidades',
                    'proyecto', 'registroCompletado', 'opcionesTitulacion',
                    'procesoTitulacion'));
        }
    }

    private function maestroAndJefeAcademiaHome($role) {
        $roleJefeAcademia = Role::$ROLE_JEFE_ACADEMIA;
        // regresamos todoo lo necesario para un dashboard
        $maestro = Maestro::findByUserId(Auth::user()->id)->first();

        return view('dashboards.jefeAcademia.home',
            compact('role', 'roleJefeAcademia', 'maestro'));
    }

    /*
     * POST Cambio de contraseña la primera vez del login excepto alumno
     * */
    public function passwordUpdate(DefaultPassRequest $request) {

        $newPass = Hash::make($request->input('password'));

        return $this->savingCustomPassword($newPass);
    }

    // get de cambio de pass
    public function editPassword() {
        return view('auth.passwords.edit');
    }

    // post de cambio de password cuando no es la primera vez del login
    public function updatePassword(PassRequest $request) {
        // primero comparamos si la antigua es igual a la almacenada
        if(Hash::check($request->input('actual_password'), Auth::user()->getAuthPassword())) {
            // ahora cambiamos la contrasena
            $newPass = Hash::make($request->input('password'));
            return $this->savingCustomPassword($newPass);
        } else {
            return redirect()->back()->with('Error', 'La contraseña actual no coincide');
        }
    }

    private function savingCustomPassword($newPass) {
        $userLogged = User::find(Auth::user()->id);
        // creando una nueva contrasena
        $userLogged->password = $newPass;
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
