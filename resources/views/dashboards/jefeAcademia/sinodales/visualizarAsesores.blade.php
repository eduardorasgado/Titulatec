@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-2">
                <a class="btn btn-primary" href="/JefeAcademias/{{ $idAcademia }}/Sinodalia">Atrás</a>
            </div>
            <div class="col-md-10">
                <h2>Proyecto del (de la) alumn@ {{ $user->nombre }} {{ $user["apellidos"] }}</h2>
            </div>
        </div>

    </div>
    <div class="jumbotron container">
        <p>Alumno: <span class="blue">{{ $user->nombre }} {{ $user->apellidos }}</span></p>
        <p>Num. Control: <span class="blue">{{ $alumno["numero_control"] }}</span></p>
        <p> Proyecto: <span class="blue">{{ $proyecto["nombre"] }}</span></p>
        <p> Carrera: <span class="blue">{{ $especialidad["nombre"] }}</span></p>
        <p> Producto: <span class="blue">{{ $proyecto["producto"] }}</span></p>
        <p>Asesores: </p>
        <ul>
            <li class="blue">{{ $presidente->nombre }} {{ $presidente->apellidos }}</li>
            <li class="blue">{{ $secretario->nombre }} {{ $secretario->apellidos }}</li>
            <li class="blue">{{ $vocal->nombre }} {{ $vocal->apellidos }}</li>
            <li class="blue">{{ $vocal_suplente->nombre }} {{ $vocal_suplente->apellidos }}</li>
        </ul>
    </div>

@endsection
