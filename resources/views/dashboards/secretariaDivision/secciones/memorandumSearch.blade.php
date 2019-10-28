@extends('layouts.app')

@section('content')
    <h2>Resultado de la busqueda</h2>
    <div class="row">
        <div class="col-md-10">
            @if(Session::has('Error'))
                <div class="alert alert-danger" role="alert" style="margin-top: 5px">
                    <span class="text-success">{{ Session::get('Error') }}</span>
                </div>
            @endif
        </div>
        <a class="btn btn-primary" href="{{ route('Memorandum.dashboard') }}">Atrás</a>
    </div>
    
    <div class="row">
        <div class="col-md-6">
            @if(!$alumno["alumno"]["procesoTitulacion"]["memorandum"])
                <h4>Alumno No Procesado</h4>
                <div class="jumboColorBlue">
                    <p>Alumno: {{ $alumno->nombre }} {{ $alumno->apellidos }}</p>
                    <p>Num. Control: {{ $alumno["alumno"]["numero_control"] }}</p>
                    <p> Proyecto: {{ $alumno["alumno"]["proyecto"]["nombre"] }}</p>
                    <p> Carrera: {{ $alumno["alumno"]["carrera"]["especialidad"]["nombre"] }}</p>
                    <p> Producto: {{ $alumno["alumno"]["proyecto"]["producto"] }}</p>
                    <div class="row">
                        <div class="col-md-2"></div>
                        <div class="col-md-4">
                            <a href="{{ route('Alumno.memorandum.generate', [$alumno["alumno"]["id"], 1]) }}" target="_blank"><button class="btn btn-secondary">Generar vista previa</button></a>
                        </div>
                        <div class="col-md-4">
                            <a href="{{ route('Alumno.memorandum.generate', [$alumno["alumno"]["id"], 0]) }}" target="_blank"><button class="btn btn-primary"
                                onclick="messaging()">Generar memorandum</button></a>
                        </div>
                    </div>
                </div>
            @else
            <h4>Alumno Procesado</h4>
            <div class="jumboColorBlue">
                    <p>Alumno: <span class="blue">{{ $alumno->nombre }} {{ $alumno->apellidos }}</span></p>
                    <p>Alumno Num Control: {{ $alumno["alumno"]["numero_control"] }}</p>
                    <p> Proyecto: {{ $alumno["alumno"]["proyecto"]["nombre"] }}</p>
                    <p> Carrera: {{ $alumno["alumno"]["carrera"]["especialidad"]["nombre"] }}</p>
                    <p> Producto: {{ $alumno["alumno"]["proyecto"]["producto"] }}</p>
                    <div class="row">
                        <div class="col-md-6"></div>
                        <div class="col-md-4">
                            <a href="{{ route('Alumno.memorandum.generate', [$alumno["alumno"]["id"], 1]) }}" target="_blank"><button class="btn btn-primary">Generar memorandum</button></a>
                        </div>
                    </div>
                </div>
            @endif
        </div>
        
    </div>
    <script>
        function messaging() {
            setTimeout(function () {
                location.reload();
            }, 5000);
        }
    </script>
@endsection
