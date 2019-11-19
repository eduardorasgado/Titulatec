@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10"></div>
            <a class="btn btn-primary" href="/home">Atrás</a>
        </div>
        <h1>Todos los planes de estudio</h1>
        <br><br>
        <p class="alert alert-info">En esta sección puede ver los planes de estudio existentes.</p>
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
        @if(count($planes) == 0)
            <div class="row">
                <div class="col-md-8">
                    <span class="alert alert-warning">Aún no hay planes de estudio.</span>
                </div>
                <div class="col-md-4">
                    <a class="btn btn-outline-success" href="{{route('PlanEstudio.create')}}">Registrar un plan de estudio</a>
                </div>
            </div>
        @endif
        <div class="row">
            @foreach($planes as $plan)
                @if($plan->estado)
                    <div class="col-md-4">
                        <div class="jumbotron jumboColorBlue">
                            <p>Clave: <span class="blue">{{ $plan->clave }}</span></p>
                             <p>Relevancia: <span class="blue badge badge-light">@if($plan->is_actual) Actual @else Antiguo @endif</span></p>
                            <p><span class="badge badge-secondary">{{ $plan->especialidad->nombre }}</span></p>
                            <p>Estado: <span class="blue">@if($plan->estado) Activo @else Desactivado @endif</span></p>
                            <br><br>
                            <div class="row">
                                <div class="col-md-4"></div>
                                <div>

                                    <form
                                            class="form-button"
                                            onsubmit="return confirm('Está seguro/a de esta acción?');"
                                            action="{{ route('PlanEstudio.destroy', ['PlanEstudio' => $plan->id]) }}" method="POST">
                                        {{ method_field('DELETE') }}
                                        {{ csrf_field() }}
                                        <button class="btn btn-danger">Eliminar</button>
                                    </form>
                                    &nbsp;&nbsp;&nbsp;&nbsp;
                                    <a href="{{ route('PlanEstudio.edit',['PlanEstudio' => $plan->id]) }}" class="btn btn-success">Modificar</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach

        </div>
    </div>
@endsection
