@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10"></div>
            <a class="btn btn-primary" href="/home">Atrás</a>
        </div>
        <h1>Todos los libros</h1>
        <br><br>
        <p class="alert alert-info">En esta sección puede ver los libros existentes.</p>
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
        @if(count($libros) == 0)
            <div class="row">
                <div class="col-md-8">
                    <span class="alert alert-warning">Aún no hay libros.</span>
                </div>
                <div class="col-md-4">
                    <a class="btn btn-outline-success" href="{{route('OpcionTitulacion.create')}}">Registrar un libro </a>
                </div>
            </div>
        @endif
        <div class="row">
            @foreach($libros as $libro)
                @if($libros)
                    <div class="col-md-4">
                        <div class="jumbotron jumboColorBlue">
                            <p>Nombre: <span class="blue">{{ $libro->numero_libro }}</span></p>
                            <p>Fecha de autorizacion: <span class="blue">{{ $libro->fecha_autorizacion }}</span></p>
                            <p>Estado: <span class="blue">@if($libro->estado) Activo @else Desactivado @endif</span></p>
                            <br><br>
                            <div class="row">
                                <div class="col-md-4"></div>
                                <div>

                                    <form
                                        class="form-button"
                                        onsubmit="return confirm('Está seguro/a de esta acción?');"
                                        action="{{ route('Libros.destroy', ['Libros' => $libro->id]) }}" method="POST">
                                        {{ method_field('DELETE') }}
                                        {{ csrf_field() }}
                                        <button class="btn btn-danger">Eliminar</button>
                                    </form>
                                    &nbsp;&nbsp;&nbsp;&nbsp;
                                    <a href="{{ route('Libros.edit',['Libros' => $libro->id]) }}" class="btn btn-success">Modificar</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach

        </div>
    </div>
@endsection
