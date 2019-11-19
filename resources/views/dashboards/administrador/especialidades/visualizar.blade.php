@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10"></div>
            <a class="btn btn-primary" href="/home">Atrás</a>
        </div>
        <h1>Todas las especialidades</h1>
        <br><br>
        <p class="alert alert-info">En esta sección puede ver las especialidades existentes.</p>
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
        @if(count($especialidades) == 0)
            <div class="row">
                <div class="col-md-8">
                    <span class="alert alert-warning">Aún no hay especialidades.</span>
                </div>
                <div class="col-md-4">
                    <a class="btn btn-outline-success" href="{{route('Especialidad.create')}}">Registrar una especialidad </a>
                </div>
            </div>
        @endif
        <div class="row">
            @foreach($especialidades as $especialidad)
                @if($especialidad->estado)
                    <div class="col-md-4">
                        <div class="jumbotron jumboColorBlue">
                            <p>Nombre: <span class="blue">{{ $especialidad->nombre }}</span></p>
                            <p><span class="badge badge-secondary">{{ $especialidad->academia->nombre }}</span></p>
                            <p>Estado: <span class="blue">@if($especialidad->estado) Activo @else Desactivado @endif</span></p>
                            <br><br>
                            <div class="row">
                                <div class="col-md-4"></div>
                                <div>

                                    <form
                                            class="form-button"
                                            onsubmit="return confirm('Está seguro/a de esta acción?');"
                                            action="{{ route('Especialidad.destroy', ['Especialidad' => $especialidad->id]) }}" method="POST">
                                        {{ method_field('DELETE') }}
                                        {{ csrf_field() }}
                                        <button class="btn btn-danger">Eliminar</button>
                                    </form>
                                    &nbsp;&nbsp;&nbsp;&nbsp;
                                    <a href="{{ route('Especialidad.edit',['Especialidad' => $especialidad->id]) }}" class="btn btn-success">Modificar</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach

        </div>
    </div>
@endsection
