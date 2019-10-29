@extends('layouts.app')

@section('content')
    <h2>Resultado de busqueda de Avisos</h2>
    <div class="row">
        <div class="col-md-10">
            @if(Session::has('Error'))
                <div class="alert alert-danger" role="alert" style="margin-top: 5px">
                    <span class="text-success">{{ Session::get('Error') }}</span>
                </div>
            @endif
        </div>
        <a class="btn btn-primary" href="{{ route('DivisionEstudios.Alumno.Avisos.generate') }}">Atrás</a>
    </div>
   
    <div class="row">
        <div class="col-md-6">
            @if(!$alumno["alumno"]["procesoTitulacion"]["avisos"])
            <h3>No Procesado</h3>
                <div class="jumboColorBlue">
                    <p>Alumno: {{ $alumno->nombre }} {{ $alumno->apellidos }}</p>
                    <p>Num. Control: {{ $alumno["alumno"]["numero_control"] }}</p>
                    <p> Proyecto: {{ $alumno["alumno"]["proyecto"]["nombre"] }}</p>
                    <p> Carrera: {{ $alumno["alumno"]["carrera"]["especialidad"]["nombre"] }}</p>
                    <p> Producto: {{ $alumno["alumno"]["proyecto"]["producto"] }}</p>
                    <div class="row">
                        <div class="col-md-8"></div>
                        <div class="col-md-2">
                            <a href="{{ route('Alumno.avisos.create', $alumno["alumno"]["id"]) }}" target="_blank"><button
                                    onclick="messaging()"
                                    class="btn btn-primary">Generar Aviso</button></a>
                        </div>
                    </div>
                </div>
            @else
                <h3>Procesado</h3>
                <div class="jumboColorBlue">
                    <p>Alumno: <span class="blue">{{ $alumno->nombre }} {{ $alumno->apellidos }}</span></p>
                    <p>Alumno Num Control: {{ $alumno["alumno"]["numero_control"] }}</p>
                    <p> Proyecto: {{ $alumno["alumno"]["proyecto"]["nombre"] }}</p>
                    <p> Carrera: {{ $alumno["alumno"]["carrera"]["especialidad"]["nombre"] }}</p>
                    <p> Producto: {{ $alumno["alumno"]["proyecto"]["producto"] }}</p>
                    <div class="row">
                        <div class="col-md-8"></div>
                        <div class="col-md-2">
                            <a href="{{ route('Alumno.avisos.create', $alumno["alumno"]["id"]) }}" target="_blank"><button class="btn btn-primary">Volver a Generar Aviso</button></a>
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
