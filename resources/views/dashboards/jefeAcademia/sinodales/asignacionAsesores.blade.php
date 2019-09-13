@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-2">
                <a class="btn btn-primary" href="/JefeAcademias/{{ $idAcademia }}/Sinodalia">Atrás</a>
            </div>
            <div class="col-md-10">
                <h2>Proyecto del alumn@ {{ $alumno["nombre"] }} {{ $alumno["apellidos"] }}</h2>
            </div>
        </div>
        <div class="row">
            <div class="col-md-10">
                @if(Session::has('Error'))
                    <div class="alert alert-danger" role="alert" style="margin-top: 5px">
                        <span class="text-success">{{ Session::get('Error') }}</span>
                    </div>
                @endif
            </div>
        </div>
    </div>
    <div class="jumbotron container">
        <p>Alumno: <span class="blue">{{ $alumno["alumno"]->user["nombre"] }} {{ $alumno["alumno"]->user['apellidos'] }}</span></p>
        <p>Num. Control: <span class="blue">{{ $alumno["alumno"]["numero_control"] }}</span></p>
        <p> Proyecto: <span class="blue">{{ $alumno["alumno"]["proyecto"]["nombre"] }}</span></p>
        <p> Carrera: <span class="blue">{{ $alumno["alumno"]["carrera"]["especialidad"]["nombre"] }}</span></p>
        <p> Producto: <span class="blue">{{ $alumno["alumno"]["proyecto"]["producto"] }}</span></p>
    </div>
    <div class="row">
        <div class="col-md-6">

        </div>
        <div class="col-md-6">

        </div>
    </div>
@endsection
