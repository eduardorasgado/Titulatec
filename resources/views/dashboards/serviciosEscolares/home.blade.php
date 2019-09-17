@extends('layouts.app')

@section('content')
    Dashboard de {{$role->nombre}}
    <div>
        <p>Bienvenid@ a tu dashboard. Esta es tu mesa de trabajo, ya puedes comenzar a
            utilizarla. Excelente día</p>
    </div>


    <div class="container">
        @if(Session::has('Error'))
            <div class="alert alert-warning" role="alert" style="margin-top: 5px">
                <span class="text-success">{{ Session::get('Error') }}</span>
            </div>
        @endif
        <div class="row">
            <div class="col-md-6">
                <div class="jumbotron jumbo-1 text-center">

                    <a href="{{ route('Acta.index') }}">
                        <button type="button" class="btn btn-success">
                            Administración de Actas
                        </button>
                    </a>
                </div>
            </div>

            <div class="col-md-6">
                <div class="jumbotron jumbo-2 text-center">
                    <div class="dropdown">
                        <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown">
                            Libros
                        </button>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="{{ route('Libros.create') }}">Agregar libro</a>
                            <a class="dropdown-item" href="{{ route('Libros.index') }}">Ver libros</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
