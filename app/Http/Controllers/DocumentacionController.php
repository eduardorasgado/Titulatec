<?php

namespace App\Http\Controllers;

use App\Alumno;
use App\Role;
use App\User;
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
                                $alumno
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

    private function generateSolicitudTitulacionAntiguoPDF($alumno) {
        //
        return view('documentos.solicitudTitulacion.antiguo');
    }
}
