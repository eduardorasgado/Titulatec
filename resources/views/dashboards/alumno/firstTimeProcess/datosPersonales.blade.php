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
                        Datos personales
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
                            <form method="POST" action="{{ route('Alumno.update', ['AlumnoCarrera' => $alumno["alumno"]["id"]]) }}">
                                {{ method_field('PUT') }}
                                @csrf

                                <div class="form-group row">
                                    <label for="direccion" class="col-md-4 col-form-label text-md-right">{{ __('Dirección') }}</label>

                                    <div class="col-md-6">
                                        <input id="direccion" type="text" class="form-control @error('direccion') is-invalid @enderror" name="direccion" value="{{ $alumno["alumno"]["direccion"] }}" required autocomplete="direccion" autofocus>

                                        @error('direccion')
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="telefono" class="col-md-4 col-form-label text-md-right">{{ __('Telefono') }}</label>

                                    <div class="col-md-6">
                                        <input id="telefono" type="number" class="form-control @error('telefono') is-invalid @enderror" name="telefono" value="{{ $alumno["alumno"]["telefono"] }}" required autocomplete="telefono" autofocus>

                                        @error('telefono')
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-4 col-form-label text-md-right" for="especialidad">Estado: </label>
                                    <div class="col-md-6">
                                        <select class="form-control" id="estado" name="estado">
                                            <option value=""  selected>Seleccione estado</option>
                                            @if($alumno["alumno"]["estado"])
                                                <option value="{{ $alumno["alumno"]["estado"] }}"  selected>{{ $alumno["alumno"]["estado"] }}</option>
                                            @endif

                                            <option value="Aguascalientes">Aguascalientes</option>

                                            <option value="Baja California">Baja California</option>

                                            <option value="Baja California Sur">Baja California Sur</option>

                                            <option value="Campeche">Campeche</option>

                                            <option value="Coahuila de Zaragoza">Coahuila de Zaragoza</option>

                                            <option value="Colima">Colima</option>

                                            <option value="Chiapas">Chiapas</option>

                                            <option value="Chihuahua">Chihuahua</option>

                                            <option value="Distrito Federal">Distrito Federal</option>

                                            <option value="Durango">Durango</option>

                                            <option value="Guanajuato">Guanajuato</option>

                                            <option value="Guerrero">Guerrero</option>

                                            <option value="Hidalgo">Hidalgo</option>

                                            <option value="Jalisco">Jalisco</option>

                                            <option value="México">México</option>

                                            <option value="Michoacán de Ocampo">Michoacán de Ocampo</option>

                                            <option value="Morelos">Morelos</option>

                                            <option value="Nayarit">Nayarit</option>

                                            <option value="Nuevo León">Nuevo León</option>

                                            <option value="Oaxaca">Oaxaca</option>

                                            <option value="Puebla">Puebla</option>

                                            <option value="Querétaro">Querétaro</option>

                                            <option value="Quintana Roo">Quintana Roo</option>

                                            <option value="San Luis Potosí">San Luis Potosí</option>

                                            <option value="Sinaloa">Sinaloa</option>

                                            <option value="Sonora">Sonora</option>

                                            <option value="Tabasco">Tabasco</option>

                                            <option value="Tamaulipas">Tamaulipas</option>

                                            <option value="Tlaxcala">Tlaxcala</option>

                                            <option value="Veracruz de Ignacio de la Llave">Veracruz de Ignacio de la Llave</option>

                                            <option value="Yucatán">Yucatán</option>

                                            <option value="Zacatecas">Zacatecas</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="ciudad" class="col-md-4 col-form-label text-md-right">{{ __('Ciudad') }}</label>

                                    <div class="col-md-6">
                                        <input id="ciudad" type="text" class="form-control @error('ciudad') is-invalid @enderror" name="ciudad" value="{{ $alumno["alumno"]["ciudad"] }}" required autocomplete="ciudad" autofocus>

                                        @error('ciudad')
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

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
