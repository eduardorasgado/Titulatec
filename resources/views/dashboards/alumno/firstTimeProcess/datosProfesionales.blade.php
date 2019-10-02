@extends('layouts.app')

@section('content')
    @if(session('Error'))
        <div class="alert alert-danger" role="alert" style="margin-top: 5px">
            <span class="text-success">{{ session('Error') }}</span>
        </div>

    @endif
    <hr>

    <div class="container">
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        Datos Profesionales
                    </div>
                    <div class="card-body">
                        <div class="row mx-auto">
                            <span class="alert alert-info">El lugar y puesto de trabajo son los actuales, en caso de no tener, dejar vacío, al igual anexo y otro TECNM son opcionales. </span>
                            @if(session('success-alumno'))
                                <div class="alert alert-success" role="alert" style="margin-top: 5px">
                                    <span class="text-success">{{ session('success-alumno') }}</span>
                                </div>

                            @endif
                            @if(session('error-alumno'))
                                <div class="alert alert-danger" role="alert" style="margin-top: 5px">
                                    <span class="text-success">{{ session('error-alumno') }}</span>
                                </div>

                            @endif
                        </div>

                        <div class="jumbotron">
                            <form method="POST" action="{{ route('Alumno.datosProfesionales', $idAlumno) }}">
                                {{ method_field('PUT') }}
                                @csrf

                                <div class="form-group row">
                                    <label for="lugar_trabajo" class="col-md-4 col-form-label text-md-right">{{ __('Lugar de trabajo') }}</label>

                                    <div class="col-md-6">
                                        <input id="lugar_trabajo" type="text" class="form-control @error('lugar_trabajo') is-invalid @enderror" name="lugar_trabajo" value="{{ $alumno["alumno"]["lugar_trabajo"] }}" autocomplete="lugar_trabajo" autofocus>

                                        @error('lugar_trabajo')
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="puesto_trabajo" class="col-md-4 col-form-label text-md-right">{{ __('Puesto de trabajo') }}</label>

                                    <div class="col-md-6">
                                        <input id="puesto_trabajo" type="text" class="form-control @error('puesto_trabajo') is-invalid @enderror" name="puesto_trabajo" value="{{ $alumno["alumno"]["puesto_trabajo"] }}" autocomplete="puesto_trabajo" autofocus>

                                        @error('puesto_trabajo')
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

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
            </div>
        </div>
    </div>
@endsection
