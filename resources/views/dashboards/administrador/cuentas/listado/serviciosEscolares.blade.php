@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10"></div>
            <a class="btn btn-primary" href="/home">Atrás</a>
        </div>
        <h1>Personal de Servicios Escolares</h1>
        <br><br>
        <p class="alert alert-info">En esta sección puede ver el personal de servicios escolares existentes.</p>
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
        @if(count($serviciosEscolares) == 0)
            <div class="row">
                <div class="col-md-8">
                    <span class="alert alert-warning">Aún no hay maestros.</span>
                </div>
                <div class="col-md-4">
                    <a class="btn btn-outline-success" href="{{route('Maestro.create')}}">Registrar un maestro </a>
                </div>
            </div>
        @endif
        <div class="row">
            @foreach($serviciosEscolares as $personal)
                @if($personal)
                    <div class="col-md-4">
                        <div class="jumbotron jumboColorBlue">
                            <p>Nombre: <span class="blue">{{ $personal->nombre }} {{ $personal->apellidos }}</span></p>
                            <p>Correo Electrónico: <span class="blue">{{ $personal->email }}</span></p>
                            <p><span class="badge badge-secondary">Departamento</span></p>
                            <p>Estado: <span class="blue">@if($personal->is_enable) Activo @else Desactivado @endif</span></p>
                            <br><br>
                            <div class="row">
                                <div class="col-md-7"></div>
                                <div>

                                    <form
                                        class="form-button"
                                        onsubmit="return confirm('Está seguro/a de esta acción?');"
                                        action="{{ route('ServiciosEscolares.destroy', ['ServiciosEscolares' => $personal->id]) }}" method="POST">
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
