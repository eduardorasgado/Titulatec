@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10"></div>
            <a class="btn btn-primary" href="/home">Atrás</a>
        </div>
        <h1>Todas las opciones de titulación</h1>
        <br><br>
        <p class="alert alert-info">En esta sección puede ver las opciones de titulación existentes.</p>
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
        @if(count($opciones) == 0)
            <div class="row">
                <div class="col-md-8">
                    <span class="alert alert-warning">Aún no hay opciones registradas.</span>
                </div>
                <div class="col-md-4">
                    <a class="btn btn-outline-success" href="{{route('OpcionTitulacion.create')}}">Registrar una Opcion de titulacion </a>
                </div>
            </div>
        @endif
        <div class="row">
            @foreach($opciones as $opcion)
                @if($opcion)
                    <div class="col-md-4">
                        <div class="jumbotron jumboColorBlue">
                            <p>Nombre: <span class="blue">{{ $opcion->nombre }}</span></p>
                            <p>Clave: <span class="blue">{{ $opcion->clave }}</span></p>
                            <p>Estado: <span class="blue">@if($opcion->estado) Activo @else Desactivado @endif</span></p>
                            <br><br>
                            <div class="row">
                                <div class="col-md-4"></div>
                                <div>

                                    <form
                                            class="form-button"
                                            onsubmit="return confirm('Está seguro/a de esta acción?');"
                                            action="{{ route('OpcionTitulacion.destroy', ['OpcionTitulacion' => $opcion->id]) }}" method="POST">
                                        {{ method_field('DELETE') }}
                                        {{ csrf_field() }}
                                        <button class="btn btn-danger">Eliminar</button>
                                    </form>
                                    &nbsp;&nbsp;&nbsp;&nbsp;
                                    <a href="{{ route('OpcionTitulacion.edit',['OpcionTitulacion' => $opcion->id]) }}" class="btn btn-success">Modificar</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach

        </div>
    </div>
@endsection