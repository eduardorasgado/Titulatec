<?php

namespace App\Http\Controllers;

use App\Alumno;
use App\Maestro;
use App\ProcesoTitulacion;
use App\Role;
use App\User;
use Barryvdh\DomPDF\Facade as PDF;
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

    public function memorandum($idAlumno, $vistaPrevia) {
        try {

            // TODO: Tratar de optimizar esta peticion porque alumno se consulta en
            // GenerateSolicitudTitulacionAntiguo
            $alumno = Alumno::findOrFail($idAlumno);
            if(!$vistaPrevia) {
                $proceso = $alumno->procesoTitulacion;
                $proceso->memorandum = true;
                $proceso->save();
            }

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

            $presidenteUser = Maestro::findOrFail($alumno["procesoTitulacion"]["asesores"]["id_presidente"]);
            $secretarioUser = Maestro::findOrFail($alumno["procesoTitulacion"]["asesores"]["id_secretario"]);
            $vocalUser = Maestro::findOrFail($alumno["procesoTitulacion"]["asesores"]["id_vocal"]);
            $vocal_suplenteUser = Maestro::findOrFail($alumno["procesoTitulacion"]["asesores"]["id_vocal_suplente"]);

            $presidente = $presidenteUser->user;
            $secretario = $secretarioUser->user;
            $vocal = $vocalUser->user;
            $vocal_suplente = $vocal_suplenteUser->user;

            $presidenteCedula = $presidenteUser->cedula_profesional;
            $secretarioCedula = $secretarioUser->cedula_profesional;
            $vocalCedula = $vocalUser->cedula_profesional;
            $vocal_suplenteCedula = $vocal_suplenteUser->cedula_profesional;

            $proyecto = $user->alumno->proyecto;
            $carrera = $user->alumno->carrera;
            $academia = $carrera->especialidad->academia;
            $jefeAcademia = User::findByJefeAcademia($academia->id)->first();
            $jefeDivision = User::where('id_role', Role::$ROLE_JEFE_DIVISION)->first();

            if($alumno){
                // verificar que los datos generales esten llenos
                $proceso = $alumno->procesoTitulacion;
                if($proceso){
                    if($proceso->datos_generales) {
                        // verificar tipo de plan de estudio de alumno
                        $tipoPlan = $alumno->carrera->planEstudio->is_actual;
                        //generando pdf
                        if($tipoPlan) {
                            // tipo actual
                            // respuesta nueva
                            return $this->viewToPDF('documentos.registroProyectoTitulacionIntegral',
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
                        } else {
                            $especialidad = $alumno->carrera->especialidad;
                            $planEstudio = $alumno->carrera->planEstudio;
                            $procesoTitulacion = ProcesoTitulacion::withOpcionTitulacion($alumno->id)->first();
                            $jefeDepartamento = User::findByJefeAcademia($academia->id)->first();
                            // tipo antiguo
                            return $this->viewToPDF('documentos.registroProyectoViejo',
                                compact('fecha',
                                    'user',
                                    'alumno',
                                    'especialidad',
                                    'planEstudio',
                                    'procesoTitulacion',
                                    'proyecto',
                                    'jefeDepartamento',
                                    'academia',
                                    'jefeDivision',
                                    'idAlumno',
                                    'presidente',
                                    'secretario',
                                    'vocal',
                                    'vocal_suplente',
                                    'presidenteCedula',
                                    'secretarioCedula',
                                    'vocalCedula',
                                    'vocal_suplenteCedula'));
                        }
                    }
                } else {
                    return redirect()->back();
                }
            }

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

        return $this->viewToPDF('documentos.avisos',
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
            $alumno = User::findByIdAlumno($idAlumno)->first();
            // buscar los datos del alumno en cuestion
            // libro, fecha final(fecha_examen_aviso),

            // armando la fecha de generacion
            $fechaGeneracion = $this->formatDateHumanSpanishForActa(Carbon::now()->timezone('America/Mexico_City'));
            $fechaGeneracionParrafo = $this->formatDateHumanSpanishForActa2(Carbon::now()->timezone('America/Mexico_City'));
            $acta = $alumno->alumno->procesoTitulacion->acta;
            if($acta) {
                $acta->fecha_generacion = $fechaGeneracion;
                $acta->save();
            }
            
            // mandamos a los asesores del alumno
            $asesores = $alumno->alumno->procesoTitulacion->asesores;

            $presidente = Maestro::find($asesores->id_presidente);
            $secretario = Maestro::find($asesores->id_secretario);
            $vocal = Maestro::find($asesores->id_vocal);
            $vocalSuplente = Maestro::find($asesores->id_vocal_suplente);

            $image_link_ovalo = public_path('images/ovalo.png');
            $image_link_acta_logo = public_path('images/acta_logo1.png');
            if($alumno) {
                return $this->viewToPDF('documentos.actas',
                        compact('alumno','acta', 'fechaGeneracionParrafo', 'presidente', 'secretario', 'vocal', 
                        'vocalSuplente', 'image_link_ovalo','image_link_acta_logo'));
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('Error', 'No existe el alumno, error: '.$e->getMessage());
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

        return $this->viewToPDF('documentos.solicitudTitulacion.actual',
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

        return $this->viewToPDF($vista,
            compact('fecha', 'userAlumno', 'alumno', 'especialidad',
                    'planEstudio', 'procesoTitulacion', 'proyecto', 'jefeDepartamento',
                'academia'));
    }

    private function viewToPDF($view, $data) {
        try {
            $time_stamp = explode(" ", Carbon::now()->timezone('America/Mexico_City')->toDateTimeString());
            $pdf_name = 'documento.'.$time_stamp[0]."-"
                .str_replace(":", ".", $time_stamp[1]).".pdf";

            $pdf = PDF::loadview($view, $data);
            // tipo de hoja y orientacion segun domPDF
            $pdf->setPaper('letter', 'portrait');
            return $pdf->stream($pdf_name);
            //return $pdf->download($pdf_name);
        } catch(\Exception $e) {
            return redirect()->back()->with('Error', $e->getMessage());
        }
    }
}
