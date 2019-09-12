@extends('layouts.app')

@section('content')
    <h2>Administración de Sinodales</h2>
    <div class="row">
        <div class="col-md-10">
            @if(Session::has('Error'))
                <div class="alert alert-danger" role="alert" style="margin-top: 5px">
                    <span class="text-success">{{ Session::get('Error') }}</span>
                </div>
            @endif
        </div>
        <a class="btn btn-primary" href="/home">Atrás</a>
    </div>
    <div class="row">
        <div class="col-md-6">
            <h3>Alumnos No procesados</h3>
        </div>
        <div class="col-md-6">
            <h3>Alumnos Procesados</h3>
        </div>
    </div>
@endsection
