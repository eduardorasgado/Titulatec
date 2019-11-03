@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-2">
                <a class="btn btn-primary" href="/Acta">Atrás</a>
            </div>
            <div class="col-md-10">
                <h2>Alumn@ {{ $acta["procesoTitulacion"]["alumno"]["user"]["nombre"] }} {{ $acta["procesoTitulacion"]["alumno"]["user"]["apellidos"] }}</h2>
            </div>
        </div>

    </div>
    <div class="jumbotron container">
        <p>Alumno: <span class="blue">{{ $acta["procesoTitulacion"]["alumno"]["user"]["nombre"] }} {{ $acta["procesoTitulacion"]["alumno"]["user"]["apellidos"] }}</span></p>
        <p>Hora y fecha de protocolo: {{ $acta["fecha_examen_aviso"] }} a las {{ $acta["hora_inicio"] }} horas</p>

        <p>Carrera:</p>
        <ul>
            <li>{{ $acta["procesoTitulacion"]["alumno"]["carrera"]["especialidad"]["nombre"] }}</li>
            <li>{{ $acta["procesoTitulacion"]["alumno"]["carrera"]["planEstudio"]["clave"] }}</li>
        </ul>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    Asignación de hora de termino y libro del acta
                    <div class="row">
                        <div class="col-md-6">
                            @if(Session::has('Error'))
                                <div class="alert alert-danger" role="alert" style="margin-top: 5px">
                                    <span class="text-danger">{{ Session::get('Error') }}</span>
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
                    <form method="PUT" action="{{ route('Acta.edit', ['Acta' => $acta["id"]] ) }}">
                        @csrf

                        <div class="form-group row">
                            <label for="hora_fin" class="col-md-4 col-form-label text-md-right">{{ __('Hora final') }}</label>

                            <div class="col-md-6">
                                <input id="hora_fin" type="text" class="form-control @error('hora_fin') is-invalid @enderror" name="hora_fin"
                                       value="{{ $acta["hora_fin"] }}"
                                       required autocomplete="hora_fin" autofocus
                                       placeholder="ejemplo: 14:00"
                                >

                                @error('hora_fin')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">


                            <label class="col-md-4 col-form-label text-md-right" for="id_libro">Libro: </label>
                            <div class="col-md-6">
                                <select class="form-control" id="id_libro" name="id_libro">
                                    <option value=""  selected>Seleccione opción de titulación</option>
                                    @if(count($libros) > 0)
                                        @foreach($libros as $libro)
                                            <option value="{{ $libro->id }}" {{ ($acta["id_libro"] == $libro->id) ? 'selected' : '' }}>Libro {{ $libro->numero_libro }}</option>
                                        @endforeach
                                    @endif
                                </select>
                                @error('id_libro')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="foja" class="col-md-4 col-form-label text-md-right">{{ __('Número de foja') }}</label>

                            <div class="col-md-6">
                                <input id="foja" type="text" class="form-control @error('foja') is-invalid @enderror" name="foja"
                                       value="{{ $acta["foja"] }}"
                                       required autocomplete="foja" autofocus
                                       placeholder="ejemplo: 93"
                                >

                                @error('foja')
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
        <div class="col-md-6">

            <div class="jumbotron jumbo-2 text-center">
                <a href="{{ route('Alumno.acta.generate',[$acta["id"]]) }}"
                >
                    <button type="button" class="btn btn-success"
                            @if($acta["id_libro"] == '' || $acta["id_libro"] == null)
                            disabled
                        @endif
                    >
                        Generar Acta
                    </button>
                </a>
            </div>

        </div>
    </div>
@endsection
