@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10"></div>
            <a class="btn btn-primary" href="/home">Atrás</a>
        </div>
        <h1>Todos los maestros del área</h1>
        <br><br>
        <p class="alert alert-info">En esta sección puede ver los maestros existentes.</p>
        <br>
        @if(Session::has('Error'))
            <div class="alert alert-warning" role="alert" style="margin-top: 5px">
                <span class="text-success">{{ Session::get('Error') }}</span>
            </div>
        @endif
        @if(session('success'))
            <div class="alert alert-success" role="alert" style="margin-top: 5px">
                <span class="text-success">{{ session('success') }}</span>
            </div>
        @endif
        @if(count($maestros) == 0)
            <div class="row">
                <div class="col-md-8">
                    <span class="alert alert-warning">Aún no hay maestros.</span>
                </div>
                <div class="col-md-4">
                    <a class="btn btn-outline-success" href="{{route('JefeAcademia.Manage.Maestro.create')}}">Registrar un maestro </a>
                </div>
            </div>
        @endif


        <div class="container-fluid">
            <div class="card card-header">
                <h3>{{ $academia->nombre }}</h3>
            </div>
            <div class="card card-body">
                <div class="row">
                    @foreach($maestros as $maestro)

                            @if($maestro->is_enable)
                            <div class="col-md-4">
                                <div class="jumbotron jumboColorBlue">
                                    <p>Nombre: <span class="blue">{{ $maestro->nombre }} {{ $maestro->apellidos }}</span></p>
                                    <p>Correo Electrónico: <span class="blue">{{ $maestro->email }}</span></p>
                                    <p><span class="badge badge-secondary">{{ $maestro->maestro['academia']['nombre'] }}</span></p>
                                    <p>Cedula Profesional: <span class="blue">{{ $maestro->maestro['cedula_profesional'] }}</span></p>
                                    <p>Especialidad: <span class="blue">{{ $maestro->maestro['especialidad_estudiada'] }}</span></p>
                                    <p>Asesorando a: <span class="blue">{{ $maestro->maestro['asesor_count'] }} alumnos</span></p>
                                    <p>Fecha de ingreso al sistema: <span class="blue">{{ $maestro->maestro['created_at'] }}</span></p>
                                    <p>Estado: <span class="blue">@if($maestro->is_enable) Activo @else Desactivado @endif</span></p>
                                    <br><br>
                                    <div class="row">
                                        <div class="col-md-7"></div>
                                        <div>

                                            {{-- TODO: Para desactivar aqui a un maestro debemos de dirigir a una ruta de jefe de academia no a Maestro.destroy--}}
                                            <form
                                                class="form-button"
                                                onsubmit="return confirm('Está seguro/a de esta acción?');"
                                                action="{{ route('Maestro.destroy', ['Maestro' => $maestro->id]) }}" method="POST">
                                                {{ method_field('DELETE') }}
                                                {{ csrf_field() }}
                                                <button class="btn btn-danger">Desactivar</button>
                                            </form>
                                            &nbsp;&nbsp;&nbsp;&nbsp;

                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
@endsection
