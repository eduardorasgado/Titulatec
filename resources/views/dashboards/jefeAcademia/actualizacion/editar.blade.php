
@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10"></div>
            <a class="btn btn-primary" href="/home">Atrás</a>
        </div>

        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Actualización de datos de maestro') }}</div>

                    <div class="alert alert-info">
                        @if(session('success'))
                            <div class="alert alert-success" role="alert" style="margin-top: 5px">
                                <span class="text-success">{{ session('success') }}</span>
                            </div>

                        @endif
                        @if(session('Error'))
                            <div class="alert alert-danger" role="alert" style="margin-top: 5px">
                                <span class="text-success">{{ session('Error') }}</span>
                            </div>

                        @endif
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('Maestro.update', ['id' => $maestro->id]) }}"
                              onsubmit="return confirm('Está seguro/a de esta acción?');"
                        >
                            {{ method_field('PUT') }}
                            @csrf

                            <div class="form-group row">
                                <label for="cedula_profesional" class="col-md-4 col-form-label text-md-right">{{ __('Cédula Profesional') }}</label>

                                <div class="col-md-6">
                                    <input id="cedula_profesional" type="" class="form-control @error('cedula_profesional') is-invalid @enderror" name="cedula_profesional" value="{{ $maestro->cedula_profesional }}"
                                           required autocomplete="nombre">

                                    @error('cedula_profesional')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="especialidad_estudiada" class="col-md-4 col-form-label text-md-right">{{ __('Especialidad Estudiada') }}</label>

                                <div class="col-md-6">
                                    <input id="especialidad_estudiada" type="" class="form-control @error('especialidad_estudiada') is-invalid @enderror" name="apellidos" value="{{ $maestro->especialidad_estudiada}}"
                                           required autocomplete="especialidad_estudiada">

                                    @error('especialidad_estudiada')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-md-4 col-form-label text-md-right" for="academia">Academia: </label>
                                <div class="col-md-6">
                                    <select class="form-control" id="academia" name="academia">
                                        @if(count($academias) > 0)
                                            @foreach ($academias as $academia)
                                                <option value="{{ $academia->id }}" @if($academia->id == $maestro->id_academia) selected @endif>{{ $academia->nombre }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="actual_password" class="col-md-4 col-form-label text-md-right">{{ __('Contraseña Actual') }}</label>

                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control @error('actual_password') is-invalid @enderror" name="actual_password"
                                           required autocomplete="actual_password">

                                    @error('actual_password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Cambiar y seguir') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
