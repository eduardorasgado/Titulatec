@extends('layouts.app')

@section('content')
    <h2>Administración de Memorandums</h2>
    <div class="row">
        <div class="col-md-10">
            @if(Session::has('Error'))
                <div class="alert alert-danger" role="alert" style="margin-top: 5px">
                    <span class="text-success">{{ Session::get('Error') }}</span>
                </div>
            @endif
        </div>
        <a class="btn btn-primary" href="/home">Atrás</a>
    </div>
    <div class="row">
        <div class="col-md-6">
            @foreach($alumnosSinMemorandum as $alumno)
                <div class="jumboColorBlue">
                    <p>Alumno: {{ $alumno->nombre }} {{ $alumno->apellidos }}</p>
                    <p>Num. Control: {{ $alumno["alumno"]["numero_control"] }}</p>
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
