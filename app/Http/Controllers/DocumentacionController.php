<?php

namespace App\Http\Controllers;

use App\Alumno;
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
                            return dd('solicitud titulacion actual');
                        } else {
                            // tipo antiguo
                            return dd('solicitud titulacion antigua');
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
}
