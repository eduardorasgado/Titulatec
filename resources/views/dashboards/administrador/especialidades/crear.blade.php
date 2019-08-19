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
                    <div class="card-header">{{ __('Registro de Especialidad') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('Especialidad.store') }}">
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
                                        {{ __('Registrar Especialidad') }}
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
