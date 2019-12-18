@extends('layouts.app')

@section('content')
    <h2>Administración de Sinodales</h2>
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

        <div class="col-md-6 jumbotron">
        <i class="fas fa-h2    ">Buscador de respuesta de departamento, buscar por numero de control</i>
            <form action="{{ route('Sinodalia.busqueda') }}" method="POST" role="search">
                {{ csrf_field() }}
                <div class="input-group">
                    <input type="hidden" name="idAcademia" value="{{ $idAcademia }}"/>
                    <input type="text" class="form-control" name="control"
                        placeholder="Buscar por número de control" required> <span class="input-group-btn">
                        <button type="submit" class="btn btn-primary">Buscar</button>
                    </span>
                </div>
            </form>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <h3>Alumnos No procesados</h3>
            @foreach($alumnosSinAsesores as $alumno)
                <div class="jumboColorBlue">
                    <p>Alumno: <span class="blue">{{ $alumno["alumno"]->user["nombre"] }} {{ $alumno["alumno"]->user['apellidos'] }}</span></p>
                    <p>Num. Control: <span class="blue">{{ $alumno["alumno"]["numero_control"] }}</span></p>
                    <p> Proyecto: <span class="blue">{{ $alumno["alumno"]["proyecto"]["nombre"] }}</span></p>
                    <p> Carrera: <span class="blue">{{ $alumno["alumno"]["carrera"]["especialidad"]["nombre"] }}</span></p>
                    <p> Producto: <span class="blue">{{ $alumno["alumno"]["proyecto"]["producto"] }}</span></p>
                    <div class="row">
                        <div class="col-md-8"></div>
                        <div class="col-md-2">
                            <a href="{{ route('Sinodalia.show', [$idAcademia, $alumno["alumno"]["id"]]) }}"><button class="btn btn-success">Registrar proyecto</button></a>
                        </div>
                    </div>
                </div>
            @endforeach
            @if(count($alumnosSinAsesores))

                <div class="mt-2 mx-auto">
                    {{-- Esto permite la paginacion de dos tablas en una misma view--}}
                    {{$alumnosSinAsesores->appends(['set1' => $alumnosConAsesores->currentPage(),
                    'set2' => $alumnosSinAsesores->currentPage()])
                    ->links()}}
                </div>
            @endif
        </div>
        <div class="col-md-6">
            <h3>Alumnos Procesados</h3>
            @foreach($alumnosConAsesores as $alumno)
                <div class="jumboColorBlue">
                    <p>Alumno: <span class="blue">{{ $alumno["alumno"]->user["nombre"] }} {{ $alumno["alumno"]->user['apellidos'] }}</span></p>
                    <p>Num. Control: <span class="blue">{{ $alumno["alumno"]["numero_control"] }}</span></p>
                    <p> Proyecto: <span class="blue">{{ $alumno["alumno"]["proyecto"]["nombre"] }}</span></p>
                    <p> Carrera: <span class="blue">{{ $alumno["alumno"]["carrera"]["especialidad"]["nombre"] }}</span></p>
                    <p> Producto: <span class="blue">{{ $alumno["alumno"]["proyecto"]["producto"] }}</span></p>
                    <div class="row">
                        <div class="col-md-4"></div>
                        <div class="col-md-4">
                            <a href="{{ route('JefeAcademia.Generate.RespuestaDepartamento', $alumno["alumno"]["id"]) }}" target="_blank"><button class="btn btn-primary">Generar Respuesta Dpto</button></a>
                        </div>
                        <div class="col-md-2">
                            @if(!$alumno["alumno"]["procesoTitulacion"]["is_proceso_finished"])
                                <a href="{{ route('Sinodalia.show', [$idAcademia, $alumno["alumno"]["id"]]) }}" target="_blank"><button class="btn btn-danger">Cambiar/Ver Asesores</button></a>
                            @else
                                <a href="{{ route('JefeAcademia.Alumno.Visualizar.Asesores',[$idAcademia, $alumno["alumno"]["id"]]) }}" target="_blank"><button class="btn btn-success">Ver Asesores</button></a>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
            @if(count($alumnosConAsesores))

                <div class="mt-2 mx-auto">
                    {{-- Esto permite la paginacion de dos tablas en una misma view--}}
                    {{$alumnosConAsesores->appends(['set1' => $alumnosConAsesores->currentPage(),
                    'set2' => $alumnosSinAsesores->currentPage()])
                    ->links()}}
                </div>
            @endif
        </div>
    </div>
@endsection
