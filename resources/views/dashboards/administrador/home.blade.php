@extends('layouts.app')

@section('content')

    <div class="container">
        <div>
            <h1>{{$role->nombre}}</h1>
            <div>
                <p>Bienvenido a tu dashboard. Esta es tu mesa de trabajo, ya puedes comenzar a
                    utilizarla. Excelente día</p>
            </div>
            @if(Session::has('Error'))
                <div class="alert alert-warning" role="alert" style="margin-top: 5px">
                    <span class="text-success">{{ Session::get('Error') }}</span>
                </div>
            @endif
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="jumbotron jumbo-1 text-center">
                    <div class="dropdown">
                        <button type="button" class="btn dropdown-toggle" data-toggle="dropdown">
                            Sistema general
                        </button>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="{{ route('OpcionTitulacion.create') }}">Agregar opcion de titulación</a>
                            <a class="dropdown-item" href="{{ route('OpcionTitulacion.index') }}">Ver opciones de titulación</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="{{ route('Role.index') }}">Ver roles disponibles</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="{{ route('Academia.create') }}">Agregar Academia</a>
                            <a class="dropdown-item" href="{{ route('Academia.index') }}">Ver Academias</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="{{ route('Especialidad.create') }}">Agregar Especialidad(Carreras)</a>
                            <a class="dropdown-item" href="{{ route('Especialidad.index') }}">Ver Especialidades(Carreras)</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="{{ route('PlanEstudio.create') }}">Agregar Plan de estudio</a>
                            <a class="dropdown-item" href="{{ route('PlanEstudio.index') }}">Ver Planes de estudio</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="jumbotron jumbo-2 text-center">
                    <div class="dropdown">
                        <button type="button" class="btn dropdown-toggle" data-toggle="dropdown">
                            Administrar departamentos
                        </button>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="{{ route('Maestro.create') }}">Agregar maestro</a>
                            <a class="dropdown-item" href="{{ route('Maestro.index') }}">Ver maestros</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="{{ route('JefesAcademia.index') }}">Jefes de academia</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="{{ route('DivisionEstudios.create') }}">Agregar Secretaria de División de Estudios</a>
                            <a class="dropdown-item" href="{{ route('DivisionEstudios.index') }}">Ver Secretarias de División de Estudios</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="">Ver Jefe de División de Estudios</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="{{ route('ServiciosEscolares.create') }}">Agregar Personal de Servicios Escolares</a>
                            <a class="dropdown-item" href="{{ route('ServiciosEscolares.index') }}">Ver Personal de Servicios Escolares</a>

                        </div>
                    </div>
                </div>
            </div>



@endsection
