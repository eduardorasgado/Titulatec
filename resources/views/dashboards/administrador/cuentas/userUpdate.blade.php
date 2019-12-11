
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
                    <div class="card-header">{{ __('Cambio de contraseña') }}</div>

                    <div class="alert alert-info">
                        @if(session('success'))
                            <div class="alert alert-success" role="alert" style="margin-top: 5px">
                                <span class="text-success">{{ session('success') }}</span>
                            </div>

                        @endif
                    </div>

                    <div class="alert alert-info">
                        Cambie su contraseña a una segura para poder continuar, procura no olvidarla.
                        @if(session('Error'))
                            <div class="alert alert-danger" role="alert" style="margin-top: 5px">
                                <span class="text-success">{{ session('Error') }}</span>
                            </div>

                        @endif
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('User.update', ['id' => $user->id]) }}">
                            @csrf

                            <div class="form-group row">
                                <label for="actual_password" class="col-md-4 col-form-label text-md-right">{{ __('Nombre') }}</label>

                                <div class="col-md-6">
                                    <input id="nombre" type="nombre" class="form-control @error('nombre') is-invalid @enderror" name="nombre" value="{{ $user->nombre }}"
                                           required autocomplete="nombre">

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
                                    <input id="apellidos" type="apellidos" class="form-control @error('apellidos') is-invalid @enderror" name="apellidos" value="{{ $user->apellidos }}"
                                           required autocomplete="apellidos">

                                    @error('apellidos')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
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

                            <br>
                            <div class="form-group row">
                                <div class="col-md-4"></div>
                                <div class="col-md-8">
                                    <span class="badge badge-warning">deja vacío en caso de no querer cambiar contraseña</span>
                                </div>

                            </div>

                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Nueva Contraseña') }}</label>

                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password"
                                           autocomplete="new-password">

                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirmar Nueva Contraseña') }}</label>

                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation"
                                           autocomplete="new-password">
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
