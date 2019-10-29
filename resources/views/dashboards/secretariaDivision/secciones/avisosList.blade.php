@extends('layouts.app')

@section('content')
    <h2>Administración de Avisos</h2>
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
        <i class="fas fa-h2    ">Buscador de avisos, buscar por numero de control</i>
            <form action="{{ route('Avisos.busqueda') }}" method="POST" role="search">
                {{ csrf_field() }}
                <div class="input-group">
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
            <h3>No Procesados</h3>
            @foreach($alumnosSinAvisos as $alumno)
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
            @endforeach
        </div>
        <div class="col-md-6">
            <h3>Procesados</h3>
            @foreach($alumnosConAvisos as $alumno)
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
            @endforeach
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
