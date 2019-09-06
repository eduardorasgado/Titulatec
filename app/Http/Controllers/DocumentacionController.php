<?php

namespace App\Http\Controllers;

use App\Alumno;
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
            //$proceso->save();

            // retornar el pdf
            return $this->generateSolicitudTitulacionAntiguoPDF(
                $alumno,'documentos.memorandum');

        } catch(\Exception $e) {
            return redirect()->back()->with('Error', 'El alumno no existe');
        }
    }

    private function generateSolicitudTitulacionActualPDF($alumno) {
        //
        $jefeDivision = User::JefeDivision()->first();
        $coordinador = User::coordinadorApoyoTitulacionDivision()->first();

        $jefeNombre = Role::find(Role::$ROLE_JEFE_DIVISION)
            ->nombre;
        $coordinadorNombre = Role::find(Role::$ROLE_COORDINADORA_APOYO_TITULACION)
            ->nombre;

        $userAlumno = $alumno->user;

        $proyecto = $alumno->proyecto;

        return view('documentos.solicitudTitulacion.actual',
                    compact('jefeDivision', 'coordinador',
                    'jefeNombre', 'coordinadorNombre', 'userAlumno', 'alumno',
                    'proyecto'));
    }

    private function generateSolicitudTitulacionAntiguoPDF($alumno, $vista) {
        //
        $fecha = Carbon::now();
        $userAlumno = $alumno->user;
        $proyecto = $alumno->proyecto;
        $especialidad = $alumno->carrera->especialidad;
        $planEstudio = $alumno->carrera->planEstudio;
        $procesoTitulacion = ProcesoTitulacion::withOpcionTitulacion($alumno->id)->first();
        // encontrando al jefe de academia del alumno
        $academia = $especialidad->academia;
        $jefeDepartamento = User::findByJefeAcademia($academia->id);

        return view($vista,
            compact('fecha', 'userAlumno', 'alumno', 'especialidad',
                    'planEstudio', 'procesoTitulacion', 'proyecto', 'jefeDepartamento',
                'academia'));
    }
}
