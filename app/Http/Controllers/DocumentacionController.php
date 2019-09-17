<?php

namespace App\Http\Controllers;

use App\Alumno;
use App\Maestro;
use App\ProcesoTitulacion;
use App\Role;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DocumentacionController extends Controller
{
    public function solicitudTitulacion($idAlumno) {
        try {
            $alumno = Alumno::findOrFail($idAlumno);

            if($alumno){
                // verificar que los datos generales esten llenos
                $proceso = $alumno->procesoTitulacion;
                if($proceso){
                    if($proceso->datos_generales) {
                        //cambiar estado en proceso titulacion de alumno
                        $proceso->solicitud_titulacion = true;
                        $proceso->save();
                        // verificar tipo de plan de estudio de alumno
                        $tipoPlan = $alumno->carrera->planEstudio->is_actual;
                        //generando pdf
                        if($tipoPlan) {
                            // tipo actual
                            return $this->generateSolicitudTitulacionActualPDF(
                                $alumno
                            );
                        } else {
                            // tipo antiguo
                            return $this->generateSolicitudTitulacionAntiguoPDF(
                                $alumno, 'documentos.solicitudTitulacion.antiguo'
                            );
                        }
                    }
                } else {
                    return redirect()->back();
                }
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error',
                "No se encuentra el alumno");
        }
    }

    public function memorandum($idAlumno) {
        try {

            // TODO: Tratar de optimizar esta peticion porque alumno se consulta en
            // GenerateSolicitudTitulacionAntiguo
            $alumno = Alumno::findOrFail($idAlumno);
            $proceso = $alumno->procesoTitulacion;
            $proceso->memorandum = true;
            $proceso->save();

            // retornar el pdf
            return $this->generateSolicitudTitulacionAntiguoPDF(
                $alumno,'documentos.memorandum');

        } catch(\Exception $e) {
            return redirect()->back()->with('Error', $e->getMessage());
        }
    }

    public function generateRespuestaDepartamento($idAlumno){
        try {
            $fecha = $this->formatDateHumanSpanish(Carbon::now()->timezone('America/Mexico_City'));
            $user = User::alumnoWithAsesoresfindByidAlumno($idAlumno)->first();
            $alumno = $user->alumno;

            $presidente = Maestro::findOrFail($alumno["procesoTitulacion"]["asesores"]["id_presidente"])->user;
            $secretario = Maestro::findOrFail($alumno["procesoTitulacion"]["asesores"]["id_secretario"])->user;
            $vocal = Maestro::findOrFail($alumno["procesoTitulacion"]["asesores"]["id_vocal"])->user;
            $vocal_suplente = Maestro::findOrFail($alumno["procesoTitulacion"]["asesores"]["id_vocal_suplente"])->user;

            $proyecto = $user->alumno->proyecto;
            $carrera = $user->alumno->carrera;
            $academia = $carrera->especialidad->academia;
            $jefeAcademia = User::findByJefeAcademia($academia->id)->first();
            $jefeDivision = User::where('id_role', Role::$ROLE_JEFE_DIVISION)->first();

            return view('documentos.registroProyectoTitulacionIntegral',
                compact('fecha',
                    'user',
                    'alumno',
                    'presidente',
                    'secretario',
                    'vocal',
                    'vocal_suplente',
                    'proyecto',
                    'carrera',
                    'academia',
                    'jefeAcademia',
                    'jefeDivision'
                ));

        } catch (\Exception $e) {
            return redirect()->back()->with('Error', 'No se ha podido generar la respuesta de departamento: '.$e);
        }
    }

    /**
     * genera el pdf del aviso del alumno basado en el acta del alumno
     * @param $idAlumno
     * @param $idProcesoTitulacion
     */
    public function generateAvisos($idAlumno, $idProcesoTitulacion) {
        // funcion que devuelve un pdf
        $fecha = $this->formatDateHumanSpanish(Carbon::now()->timezone('America/Mexico_City'));
        $user = User::alumnoWithAsesoresfindByidAlumno($idAlumno)->first();
        $alumno = $user->alumno;

        $presidente = Maestro::findOrFail($alumno["procesoTitulacion"]["asesores"]["id_presidente"])->user;
        $secretario = Maestro::findOrFail($alumno["procesoTitulacion"]["asesores"]["id_secretario"])->user;
        $vocal = Maestro::findOrFail($alumno["procesoTitulacion"]["asesores"]["id_vocal"])->user;
        $vocal_suplente = Maestro::findOrFail($alumno["procesoTitulacion"]["asesores"]["id_vocal_suplente"])->user;

        $proyecto = $user->alumno->proyecto;
        $carrera = $user->alumno->carrera;
        $especialidad = $carrera->especialidad;
        $acta = $alumno["procesoTitulacion"]["acta"];

        return view('documentos.avisos',
                compact(
                    'fecha',
                    'user',
                    'alumno',
                    'presidente',
                    'secretario',
                    'vocal',
                    'vocal_suplente',
                    'proyecto',
                    'especialidad',
                    'acta'
                ));
    }

    public function generateActa($idAlumno) {
        try {
            $alumno = Alumno::findOrFail($idAlumno);
            if($alumno) {
                return dd('Se ha generado el acta del alumno: '.$idAlumno);
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('Error', 'No existe el alumno');
        }

    }

    private function generateSolicitudTitulacionActualPDF($alumno) {
        //
        $fecha = $this->formatDateHumanSpanish(Carbon::now()->timezone('America/Mexico_City'));
        $jefeDivision = User::JefeDivision()->first();
        $coordinador = User::coordinadorApoyoTitulacionDivision()->first();

        $jefeNombre = Role::find(Role::$ROLE_JEFE_DIVISION)
            ->nombre;
        $coordinadorNombre = Role::find(Role::$ROLE_COORDINADORA_APOYO_TITULACION)
            ->nombre;

        $userAlumno = $alumno->user;
        $especialidad = $alumno->carrera->especialidad;

        $proyecto = $alumno->proyecto;

        return view('documentos.solicitudTitulacion.actual',
                    compact('jefeDivision', 'coordinador', 'especialidad',
                    'jefeNombre', 'coordinadorNombre', 'userAlumno', 'alumno',
                    'proyecto', 'fecha'));
    }

    private function generateSolicitudTitulacionAntiguoPDF($alumno, $vista) {
        //
        $fecha = $this->formatDateHumanSpanish(Carbon::now()->timezone('America/Mexico_City'));
        $userAlumno = $alumno->user;
        $proyecto = $alumno->proyecto;
        $especialidad = $alumno->carrera->especialidad;
        $planEstudio = $alumno->carrera->planEstudio;
        $procesoTitulacion = ProcesoTitulacion::withOpcionTitulacion($alumno->id)->first();
        // encontrando al jefe de academia del alumno
        $academia = $especialidad->academia;
        $jefeDepartamento = User::findByJefeAcademia($academia->id)->first();

        return view($vista,
            compact('fecha', 'userAlumno', 'alumno', 'especialidad',
                    'planEstudio', 'procesoTitulacion', 'proyecto', 'jefeDepartamento',
                'academia'));
    }
}
