@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-2">
                <a class="btn btn-primary" href="/DivisionEstudios/home/Avisos">Atrás</a>
            </div>
            <div class="col-md-10">
                <h2>Alumn@ {{ $user["nombre"] }} {{ $user["apellidos"] }}</h2>
            </div>
        </div>

    </div>
    <div class="jumbotron container">
        <p>Alumno: <span class="blue">{{ $user["nombre"] }} {{ $user['apellidos'] }}</span></p>
        <p>Num. Control: <span class="blue">{{ $alumno["numero_control"] }}</span></p>
        <p> Proyecto: <span class="blue">{{ $proyecto["nombre"] }}</span></p>
        <p> Producto: <span class="blue">{{ $proyecto["producto"] }}</span></p>

        <p>Asesores:</p>
        <ul>
            <li>{{ $presidente->nombre }} {{ $presidente->apellidos }}</li>
            <li>{{ $secretario->nombre }} {{ $secretario->apellidos }}</li>
            <li>{{ $vocal->nombre }} {{ $vocal->apellidos }}</li>
            <li>{{ $vocal_suplente->nombre }} {{ $vocal_suplente->apellidos }}</li>
        </ul>
        <p>Número de estudiantes: {{ $proyecto->num_total_integrantes }}</p>

        <p>Carrera:</p>
        <ul>
            <li>{{ $carrera->especialidad->nombre }}</li>
            <li>{{ $carrera->planEstudio->clave }}</li>
        </ul>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    Asignación de fecha y hora de acto de recepción profesional
                    <div class="row">
                        <div class="col-md-6">
                            @if(Session::has('Error'))
                                <div class="alert alert-danger" role="alert" style="margin-top: 5px">
                                    <span class="text-success">{{ Session::get('Error') }}</span>
                                </div>
                            @endif
                            @if(Session::has('success'))
                                <div class="alert alert-success" role="alert" style="margin-top: 5px">
                                    <span class="text-success">{{ Session::get('success') }}</span>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <form method="POST" action="">
                        @csrf

                        <div class="form-group row">
                            <label for="fecha_examen_aviso" class="col-md-4 col-form-label text-md-right">{{ __('Fecha') }}</label>

                            <div class="col-md-6">
                                <input id="fecha_examen_aviso" type="text" class="form-control @error('fecha_examen_aviso') is-invalid @enderror" name="fecha_examen_aviso"
                                       value="{{ $acta["fecha_examen_aviso"] }}"
                                       required autocomplete="fecha_examen_aviso" autofocus>

                                @error('fecha_examen_aviso')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="hora_inicio" class="col-md-4 col-form-label text-md-right">{{ __('Hora de Inicio') }}</label>

                            <div class="col-md-6">
                                <input id="hora_inicio" type="text" class="form-control @error('hora_inicio') is-invalid @enderror" name="hora_inicio" value="{{ $acta["hora_inicio"] }}" required autocomplete="hora_inicio" autofocus>

                                @error('hora_inicio')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="lugar_protocolo" class="col-md-4 col-form-label text-md-right">{{ __('Lugar del Protocolo') }}</label>

                            <div class="col-md-6">
                                <input id="lugar_protocolo" type="text" class="form-control @error('lugar_protocolo') is-invalid @enderror" name="lugar_protocolo" value="{{ $acta["lugar_protocolo"] }}" required autocomplete="lugar_protocolo" autofocus>

                                @error('lugar_protocolo')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <input type="hidden"value="{{ $alumno->id }}" name="idAlumno" id="idAlumno">

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Guardar') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-6">

                <div class="jumbotron jumbo-2 text-center">
                    <a href="{{ route('DivisionEstudios.Alumno.Avisos.generate.pdf',[$alumno->id, $alumno["procesoTitulacion"]["id"]]) }}">
                        <button type="button" class="btn btn-success">
                            Generar Aviso
                        </button>
                    </a>
                </div>

        </div>
    </div>
@endsection
