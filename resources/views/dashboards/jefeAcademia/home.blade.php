@extends('layouts.app')

@section('content')

    <br/>
    @if($role->id == $roleJefeAcademia)
        <div class="jumbotron">
            Bienvenid@,
            <p>Dashboard del {{$role->nombre}}. <span class="badge badge-success">{{ $maestro->academia->nombre }}</span></p>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        Ficha de datos
                    </div>
                    <div class="card-body">
                        <p>Nombre: <span class="blue"></span>{{ Auth::user()->nombre }}</p>
                        <p>Apellidos: <span class="blue"></span>{{ Auth::user()->apellidos }}</p>
                        <p>Correo Electrónico: <span class="blue"></span>{{ Auth::user()->email }}</p>
                        <p>Cédula Profesional: <span class="blue">{{ $maestro->cedula_profesional }}</span></p>
                        <p>Especialidad Estudiada: <span class="blue">{{ $maestro->especialidad_estudiada }}</span></p>
                        <p>Número de Asesorías: <span class="blue">{{ $maestro->asesor_count }}</span></p>
                        <p>Academia: <span class="blue">{{ $maestro->academia->nombre }}</span></p>
                        <div class="row">
                            <div class="col-md-6">
                                <a href="{{ route('Maestro.edit', ['Maestro' => $maestro->id]) }}">
                                    <button class="btn btn-outline-secondary">Editar Datos</button></a>
                            </div>
                            <div class="col-md-6">

                                <a href="{{ route('Auth.password.change') }}">
                                    <button class="btn btn-outline-secondary">Cambiar Contraseña</button></a>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <h3>Administración de jefe de academia</h3>
                <div class="jumbotron jumbo-1 text-center">
                    <div class="dropdown">
                        <button type="button" class="btn dropdown-toggle" data-toggle="dropdown">
                            Maestros del área
                        </button>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="{{ route('JefeAcademia.Manage.Maestro.create') }}">Agregar maestro</a>
                            <a class="dropdown-item" href="{{ route('JefeAcademia.Manage.Maestros.visualizar', $maestro->academia->id) }}">Ver maestros</a>
                        </div>
                    </div>
                </div>
                <div class="jumbotron jumbo-1 text-center">
                    <a href="{{ route('JefeAcademia.Manage.Sinodalia.index', $maestro->academia->id) }}"><button class="btn btn-outline-primary">Sinodalías del área</a>
                </div>
            </div>
        </div>
        @else
        <div class="jumbotron">
            Bienvenid@,
            <p>Dashboard del {{$role->nombre}}. En caso de ser asignado como jefe de academia podrá realizar operaciones aquí.
                <span class="badge badge-success">{{ $maestro->academia->nombre }}</span></p>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        Ficha de datos
                    </div>
                    <div class="card-body">
                        <p>Nombre: <span class="blue"></span>{{ Auth::user()->nombre }}</p>
                        <p>Apellidos: <span class="blue"></span>{{ Auth::user()->apellidos }}</p>
                        <p>Correo Electrónico: <span class="blue"></span>{{ Auth::user()->email }}</p>
                        <p>Cédula Profesional: <span class="blue">{{ $maestro->cedula_profesional }}</span></p>
                        <p>Especialidad Estudiada: <span class="blue">{{ $maestro->especialidad_estudiada }}</span></p>
                        <p>Número de Asesorías: <span class="blue">{{ $maestro->asesor_count }}</span></p>
                        <p>Academia: <span class="blue">{{ $maestro->academia->nombre }}</span></p>
                        <div class="row">
                            <div class="col-md-6">
                                <a href="{{ route('Maestro.edit', ['Maestro' => $maestro->id]) }}">
                                    <button class="btn btn-outline-secondary">Editar Datos</button></a>
                            </div>
                            <div class="col-md-6">

                                <a href="{{ route('Auth.password.change') }}">
                                    <button class="btn btn-outline-secondary">Cambiar Contraseña</button></a>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">

            </div>
        </div>
    @endif

@endsection
