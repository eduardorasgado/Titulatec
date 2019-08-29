@extends('layouts.app')

@section('content')
    Dashboard de {{$role->nombre}}

    <div class="row">
        <div class="col-md-6">
            @foreach($alumnosSinMemorandum as $alumno)
                <div class="jumboColorBlue">
                    <p>Alumno: {{ $alumno->nombre }}</p>
                    <p>Alumno Num Control: {{ $alumno["alumno"]["ciudad"] }}</p>
                    <p> Proyecto: {{ $alumno["alumno"]["proyecto"]["nombre"] }}</p>
                    <p> Carrera: {{ $alumno["alumno"]["carrera"]["especialidad"]["nombre"] }}</p>
                    <p> Producto: {{ $alumno["alumno"]["proyecto"]["producto"] }}</p>
                    <div class="row">
                        <div class="col-md-8"></div>
                        <div class="col-md-2">
                            <a href="{{ route('Alumno.memorandum.generate', $alumno["alumno"]["id"]) }}"><button class="btn btn-primary">Generar memorandum</button></a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="col-md-6">
            @foreach($alumnosConMemorandum as $alumno)
                <div class="jumboColorBlue">
                    <p>Alumno: <span class="blue">{{ $alumno->nombre }}</span></p>
                    <p>Alumno Num Control: {{ $alumno["alumno"]["ciudad"] }}</p>
                    <p> Proyecto: {{ $alumno["alumno"]["proyecto"]["nombre"] }}</p>
                    <p> Carrera: {{ $alumno["alumno"]["carrera"]["especialidad"]["nombre"] }}</p>
                    <p> Producto: {{ $alumno["alumno"]["proyecto"]["producto"] }}</p>
                </div>
            @endforeach
        </div>
    </div>
@endsection
