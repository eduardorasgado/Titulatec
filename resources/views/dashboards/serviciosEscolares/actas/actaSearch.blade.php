@extends('layouts.app')

@section('content')
    <h2>Resultado de la búsqueda de Actas</h2>
    <div class="row">
        <div class="col-md-10">
            @if(Session::has('Error'))
                <div class="alert alert-danger" role="alert" style="margin-top: 5px">
                    <span class="text-success">{{ Session::get('Error') }}</span>
                </div>
            @endif
        </div>
        <a class="btn btn-primary" href="{{ route('Acta.index') }}">Atrás</a>
    </div>
    <div class="row">
        <div class="col-md-6">
        @if(!$alumno["alumno"]["procesoTitulacion"]["is_proceso_finished"])
            <h3>No Generada</h3>
            
                <div class="jumboColorBlue">
                    <p>Alumno: <span class="blue">{{ $alumno->nombre }} {{ $alumno->apellidos }}</span></p>
                    <p>Num. Control: <span class="blue">{{ $alumno["alumno"]["numero_control"] }}</span></p>
                    <p>fecha de protocolo: <span class="blue">{{ $alumno["alumno"]["procesoTitulacion"]["acta"]["fecha_examen_aviso"] }}</span></p>
                    <p>hora de inicio de protocolo: <span class="blue">{{ $alumno["alumno"]["procesoTitulacion"]["acta"]["hora_inicio"] }} horas</span></p>
                    <div class="row">
                        <div class="col-md-8"></div>
                        <div class="col-md-2">
                            <a href="{{ route('Acta.show',['Acta' => $alumno["alumno"]["procesoTitulacion"]["acta"]["id"]]) }}" target="_blank"><button class="btn btn-primary">Generar Acta</button></a>
                        </div>
                    </div>
                </div>
            
        @else
            <h3>Generada</h3>
            
                <div class="jumboColorBlue">
                    <p>Alumno: <span class="blue">{{ $alumno->nombre }} {{ $alumno->apellidos }}</span></p>
                    <p>Num. Control: <span class="blue">{{ $alumno["alumno"]["numero_control"] }}</span></p>
                    <p>fecha de protocolo: <span class="blue">{{ $alumno["alumno"]["procesoTitulacion"]["acta"]["fecha_examen_aviso"] }}</span></p>
                    <p>hora de inicio de protocolo: <span class="blue">{{ $alumno["alumno"]["procesoTitulacion"]["acta"]["hora_inicio"] }} horas</span></p>
                    <div class="row">
                        <div class="col-md-8"></div>
                        <div class="col-md-2">
                            <a href="{{ route('Acta.show', ['Acta' => $alumno["alumno"]["procesoTitulacion"]["acta"]["id"]]) }}" target="_blank"><button class="btn btn-primary">Volver a Generar Acta</button></a>
                        </div>
                    </div>
                </div>
            
        @endif
        </div>
    </div>
@endsection
