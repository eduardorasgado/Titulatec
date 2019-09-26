@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    1. Registro de datos de carrera
                </div>
                <div class="card-body">
                    <div class="row mx-auto">
                        <span class="alert alert-info">Atención: una vez iniciado el proceso de papeleo, ya no es posible cambiar la carrera</span>
                        @if(session('success-especialidad'))
                            <div class="alert alert-success" role="alert" style="margin-top: 5px">
                                <span class="text-success">{{ session('success-especialidad') }}</span>
                            </div>

                        @endif
                        @if(session('error-especialidad'))
                            <div class="alert alert-danger" role="alert" style="margin-top: 5px">
                                <span class="text-success">{{ session('error-especialidad') }}</span>
                            </div>

                        @endif
                    </div>

                    <div class="card-body">
                        <div id="init-proyect" class="row">
                            <div class="col-md-4">
                            <span class="" style="font-size: 9px; padding:0; margin:0">
                                Para crear un nuevo proyecto, ten en cuenta que si el proyecto es entre varios integrantes, vas a ser el responsable de rellenar correctamente todos los datos del proyecto.
                            </span>
                                <a href="{{ route('Proyecto.create') }}"><button class="btn btn-outline-primary">Crear Proyecto</button></a>
                            </div>
                            <div class="col-md-8">
                            <span class="" style="font-size: 9px; padding:0; margin:0">
                                En caso de tener un equipo, el primero en haber creado el proyecto en el sistema, debe de proporcionarte el siguiente código.
                            </span>
                                <div class="row mx-auto">
                                    @if(session('error-verification'))
                                        <div class="alert alert-danger" role="alert" style="margin-top: 5px">
                                            <span class="text-success">{{ session('error-verification') }}</span>
                                        </div>

                                    @endif
                                </div>
                                <form method="POST" action="{{ route('Alumno.verificar.codigo', $idAlumno) }}">
                                    @csrf
                                    <div class="form-group row">
                                        <label for="direccion" class="col-md-4 col-form-label text-md-right">{{ __('Código de proyecto') }}</label>

                                        <div class="col-md-6">
                                            <input id="codigo" type="text" class="form-control @error('codigo') is-invalid @enderror" name="codigo" value="{{ old('codigo') }}" required autocomplete="codigo" autofocus>

                                            @error('codigo')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row mb-0">
                                        <div class="col-md-6 offset-md-4">
                                            <button type="submit" class="btn btn-primary">
                                                {{ __('Cargar proyecto') }}
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
    </div>
@endsection
