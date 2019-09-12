@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10"></div>
            <a class="btn btn-primary" href="/home">Atrás</a>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-8">

                @if(session('success'))
                    <div class="alert alert-success" role="alert" style="margin-top: 5px">
                        <span class="text-success">{{ session('success') }}</span>
                    </div>

                @endif
                @if(session('error'))
                    <div class="alert alert-danger" role="alert" style="margin-top: 5px">
                        <span class="text-success">{{ session('error') }}</span>
                    </div>

                @endif

                <div class="card">
                    <div class="card-header">{{ __('Registro de maestro') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('JefeAcademia.Manage.Maestro.create') }}">
                            @csrf

                            <div class="form-group row">
                                <label for="nombre" class="col-md-4 col-form-label text-md-right">{{ __('Nombre') }}</label>

                                <div class="col-md-6">
                                    <input id="nombre" type="text" class="form-control @error('nombre') is-invalid @enderror" name="nombre" value="{{ old('nombre') }}" required autocomplete="nombre" autofocus>

                                    @error('nombre')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="apellidos" class="col-md-4 col-form-label text-md-right">{{ __('Apellidos') }}</label>

                                <div class="col-md-6">
                                    <input id="apellidos" type="text" class="form-control @error('apellidos') is-invalid @enderror" name="apellidos" value="{{ old('apellidos') }}" required autocomplete="apellidos" autofocus>

                                    @error('apellidos')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Correo Electrónico') }}</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="cedula_profesional" class="col-md-4 col-form-label text-md-right">{{ __('Cedula Profesional') }}</label>

                                <div class="col-md-6">
                                    <input id="cedula_profesional" type="text" class="form-control @error('cedula_profesional') is-invalid @enderror" name="cedula_profesional" value="{{ old('cedula_profesional') }}" required autocomplete="cedula_profesional" autofocus>

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
                                    <input id="especialidad_estudiada" type="text" class="form-control @error('especialidad_estudiada') is-invalid @enderror" name="especialidad_estudiada" value="{{ old('especialidad_estudiada') }}" required autocomplete="especialidad_estudiada" autofocus>

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
                                            <option value="{{ $academias[0]->id }}">{{ $academias[0]->nombre }}</option>
                                            @foreach ($academias as $academia)
                                                @if($academia->id != $academias[0]->id)
                                                    <option value="{{ $academia->id }}">{{ $academia->nombre }}</option>
                                                @endif
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Registrar maestro') }}
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
