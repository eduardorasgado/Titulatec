<?php

namespace App\Http\Controllers;

use App\Alumno;
use App\Http\Requests\ProyectoRequest;
use App\Proyecto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProyectoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('proyecto.crear');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProyectoRequest $request)
    {
        // generando codigo
        $passed = false;
        while(! $passed) {
            $code = $this->generateCode();
            if(!Proyecto::where("codigo_compartido", "=", $code)->first()) {
                $passed = true;
            }
        }

        $alumnoId = Auth::user()->alumno->id;

        $proyecto = Proyecto::create([
            'nombre' => $request->input('nombre'),
            'producto' => $request->input('producto'),
            'num_total_integrantes' => $request->input('num_total_integrantes'),
            'conteo_registrados' => 1,
            'codigo_compartido' => $code,
            'id_creador' => $alumnoId,
            'is_closed' => false
        ]);

        // guardando el id del proyecto dentro del alumno
        $alumno = Alumno::find($alumnoId);
        if($alumno) {
            $alumno->id_proyecto = $proyecto->id;
            $alumno->save();
        }

        return redirect('/home')->with('success', 'Proyecto creado, regrese a su dashboard para verificar');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Proyecto  $proyecto
     * @return \Illuminate\Http\Response
     */
    public function show(Proyecto $proyecto)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Proyecto  $proyecto
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $proyecto = Proyecto::find($id);
        return view('proyecto.editar',
                compact('proyecto'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Proyecto  $proyecto
     * @return \Illuminate\Http\Response
     */
    public function update(ProyectoRequest $request, $id)
    {
        $proyecto = Proyecto::find($id);

        $proyecto->nombre = $request->input('nombre');
        $proyecto->producto = $request->input('producto');
        //$alumnos = $proyecto->alumnos;

        if($request->input('num_total_integrantes') >= $proyecto->conteo_registrados){
            $proyecto->num_total_integrantes = $request->input('num_total_integrantes');
        }
        $proyecto->save();

        return redirect('/home')->with('success', 'Se ha actualizado con éxito el proyecto');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Proyecto  $proyecto
     * @return \Illuminate\Http\Response
     */
    public function destroy(Proyecto $proyecto)
    {

    }

    /**
     * Funcion que permite procesar el codigo de proyecto
     * @param Request $request
     */
    public function exchangeProyectoCode(Request $request, $idAlumno) {
        $proyecto = Proyecto::where('codigo_compartido', '=', $request->input('codigo'));
        $count = $proyecto->count();
        $proyecto = $proyecto->first();
        if($count > 0) {
            if(($proyecto->conteo_registrados + 1) <= $proyecto->num_total_integrantes) {
                $alumno = Alumno::find($idAlumno);
                if($alumno) {
                    // TODO: Verificar que el alumno sea de la misma carrera que el creador
                    // para ello tambien debemos verificar la carrera en el home del alumno
                    $alumno->id_proyecto = $proyecto->id;
                    $alumno->save();

                    $proyecto->conteo_registrados = $proyecto->conteo_registrados + 1;
                    $proyecto->save();
                } else {
                    //return redirect()->back()->with('error-verification', 'El alumno no existe');
                    return redirect('Alumno/'.$idAlumno.'/proyecto/select')->with('error-verification', 'El alumno no existe');
                }
            } else {
                //return redirect()->back()->with('error-verification', 'Los integrantes de este proyecto ya están completos');
                return redirect('Alumno/'.$idAlumno.'/proyecto/select')->with('error-verification',
                    'Los integrantes de este proyecto ya están completos');
            }
            return redirect('/home');
        } else {
            //return redirect()->back()->with('error-verification', 'Codigo verificado con éxito');
            return redirect('Alumno/'.$idAlumno.'/proyecto/select')->with('error-verification', 'No fue posible verificar el codigo');
        }
    }

    public function generateCode() {
        return $this->getToken(20);
    }

    // UITLIDADES

    public function getToken($length){
        $token = "";
        $codeAlphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $codeAlphabet.= "abcdefghijklmnopqrstuvwxyz";
        $codeAlphabet.= "0123456789";
        $max = strlen($codeAlphabet); // edited

        for ($i=0; $i < $length; $i++) {
            $token .= $codeAlphabet[random_int(0, $max-1)];
        }

        return $token;
    }

    public function accessProyectSelector($idAlumno) {
        //
        return view('dashboards.alumno.firstTimeProcess.proyecto',
            compact('idAlumno'));
    }
}
