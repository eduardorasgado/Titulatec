@extends('layouts.app')

@section('content')
    Dashboard de {{$role->nombre}}
    <div>
        <p>Bienvenido a tu dashboard. Esta es tu mesa de trabajo, ya puedes comenzar a
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

                        <a href="{{ route('Memorandum.dashboard') }}">
                            <button type="button" class="btn btn-success">
                                Memorandums
                            </button>
                        </a>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="jumbotron jumbo-2 text-center">
                        <a href="{{ route('DivisionEstudios.Alumno.Avisos.generate') }}">
                            <button type="button" class="btn btn-success">
                                Avisos
                            </button>
                        </a>
                    </div>
                </div>
            </div>

                <h5>Información del usuario</h5>
                <div class="row">
                    <div class="col-md-6">
                        <div class="jumbotron jumbo-1 text-center">
                            <a href="{{ route('User.edit') }}">
                                <button class="btn btn-outline-secondary">Cambiar datos de acceso a cuenta</button></a>
                        </div>
                    </div>
                </div>
        </div>


@endsection
