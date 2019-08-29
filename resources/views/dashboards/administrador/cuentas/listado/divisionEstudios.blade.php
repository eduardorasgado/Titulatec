@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10"></div>
            <a class="btn btn-primary" href="/home">Atrás</a>
        </div>
        <h1>Personal de División de Estudios</h1>
        <br><br>
        <p class="alert alert-info">En esta sección puede ver el personal de división de estudios existente.</p>
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
        @if(count($divisionEstudios) == 0)
            <div class="row">
                <div class="col-md-8">
                    <span class="alert alert-warning">Aún no hay personal.</span>
                </div>
                <div class="col-md-4">
                    <a class="btn btn-outline-success" href="{{route('DivisionEstudios.create')}}">Registrar personal </a>
                </div>
            </div>
        @endif
        <div class="row">
            @foreach($divisionEstudios as $personal)
                @if($personal)
                    <div class="col-md-4">
                        <div class="jumbotron jumboColorBlue">
                            <p>Nombre: <span class="blue">{{ $personal->nombre }} {{ $personal->apellidos }}</span></p>
                            <p>Correo Electrónico: <span class="blue">{{ $personal->email }}</span></p>
                            @if($personal->id_role == $roleJefe)
                                <p><span class="badge badge-danger">{{ $personal->role->nombre }}</span></p>
                            @endif
                            @if($personal->id_role == $roleCoordinador)
                                <p><span class="badge badge-dark">{{ $personal->role->nombre }}</span></p>
                            @endif
                            <p>Estado: <span class="blue">@if($personal->is_enable) Activo @else Desactivado @endif</span></p>
                            <br><br>
                            <div class="row">
                                <div class="col-md-7"></div>
                                <div>

                                    <form
                                            class="form-button"
                                            onsubmit="return confirm('Está seguro/a de esta acción?');"
                                            action="{{ route('DivisionEstudios.destroy', ['DivisionEstudios' => $personal->id]) }}" method="POST">
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
@endsection
