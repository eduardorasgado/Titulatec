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
                    <div class="card-header">{{ __('Registro de Plan de Estudio') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('PlanEstudio.store') }}">
                            @csrf

                            <div class="form-group row">
                                <label for="nombre" class="col-md-4 col-form-label text-md-right">{{ __('Clave') }}</label>

                                <div class="col-md-6">
                                    <input id="clave" type="text" class="form-control @error('clave') is-invalid @enderror" name="clave" value="{{ old('clave') }}" required autocomplete="clave" autofocus>

                                    @error('clave')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <!--radiobutton -->
                            <div id="" class="form-group row">
                                <label for="gender" class="col-md-4 control-form-label text-md-right">Relevancia</label>
                                <div class="col-md-6">
                                    <div class="radio">
                                        <label><input id="" type="radio" name="is_actual" value="1" {{ (old('is_actual') == '1') ? 'checked' : '' }} checked>Actual</label>
                                    </div>
                                    <div class="radio">
                                        <label><input id="" type="radio" name="is_actual" value="0" {{ (old('is_actual') == '0') ? 'checked' : '' }} >Antiguo</label>
                                    </div>
                                @if ($errors->has('is_actual'))
                                    <span class="help-block">
                                     <strong>{{ $errors->first('is_actual') }}</strong>
                                     </span>
                                @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-md-4 col-form-label text-md-right" for="academia">Especialidad: </label>
                                <div class="col-md-6">
                                    <select class="form-control" id="especialidad" name="especialidad">
                                        @if(count($especialidades) > 0)
                                            <option value="{{ $especialidades[0]->id }}">{{ $especialidades[0]->nombre }}</option>
                                            @foreach ($especialidades as $especialidad)
                                                @if($especialidad->id != $especialidades[0]->id)
                                                    <option value="{{ $especialidad->id }}">{{ $especialidad->nombre }}</option>
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
