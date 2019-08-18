@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10"></div>
            <a class="btn btn-primary" href="/home">Atrás</a>
        </div>
        <h1>Todos los roles</h1>
        <br><br>
        <p class="alert alert-info">En esta sección puede ver los roles existentes.</p>
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
        @if(count($roles) == 0)
            <div class="row">
                <div class="col-md-8">
                    <span class="alert alert-warning">Aún no hay roles registrad@s.</span>
                </div>
                <div class="col-md-4">

                </div>
            </div>
        @endif
        <div class="row">
            @foreach($roles as $role)
                @if($role)
                    <div class="col-md-4">
                        <div class="jumbotron jumboColorBlue">
                            <p>Nombre: <span class="blue">{{ $role->nombre }}</span></p>
                            <p>Descripción: <span class="blue">{{ $role->descripcion }}</span></p>

                            <br><br>
                            <div class="row">
                                <div class="col-md-4"></div>
                                <div>

                                    &nbsp;&nbsp;&nbsp;&nbsp;
                                    <a href="{{ route('Role.edit',['Role' => $role->id]) }}" class="btn btn-success">Modificar</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach

        </div>
    </div>
@endsection