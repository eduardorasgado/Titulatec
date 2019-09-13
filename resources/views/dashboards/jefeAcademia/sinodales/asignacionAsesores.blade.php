@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-2">
                <a class="btn btn-primary" href="/JefeAcademias/{{ $idAcademia }}/Sinodalia">Atrás</a>
            </div>
            <div class="col-md-10">
                <h2>Proyecto del alumn@ {{ $alumno["nombre"] }} {{ $alumno["apellidos"] }}</h2>
            </div>
        </div>
        <div class="row">
            <div class="col-md-10">
                @if(Session::has('Error'))
                    <div class="alert alert-danger" role="alert" style="margin-top: 5px">
                        <span class="text-success">{{ Session::get('Error') }}</span>
                    </div>
                @endif
            </div>
        </div>
    </div>
    <div class="jumbotron container">
        <p>Alumno: <span class="blue">{{ $alumno["alumno"]->user["nombre"] }} {{ $alumno["alumno"]->user['apellidos'] }}</span></p>
        <p>Num. Control: <span class="blue">{{ $alumno["alumno"]["numero_control"] }}</span></p>
        <p> Proyecto: <span class="blue">{{ $alumno["alumno"]["proyecto"]["nombre"] }}</span></p>
        <p> Carrera: <span class="blue">{{ $alumno["alumno"]["carrera"]["especialidad"]["nombre"] }}</span></p>
        <p> Producto: <span class="blue">{{ $alumno["alumno"]["proyecto"]["producto"] }}</span></p>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    Asignación de asesores
                </div>
                <div class="card-body">
                    <form method="POST" action="">
                        @csrf

                        <input type="hidden"value="{{ $alumno->alumno->id }}" name="idAlumno" id="idAlumno">
                        <div class="form-group row">

                            <label class="col-md-4 col-form-label text-md-right" for="opcion">Presidente: </label>
                            <div class="col-md-6">
                                <select class="form-control" id="presidente" name="presidente">
                                    <option value=""  selected>Seleccione profesor</option>
                                    @if(count($maestros) > 0)
                                        @foreach($maestros as $maestro)
                                            <option value="{{ $maestro->maestro->id }}" {{ ($maestro->maestro["asesores"]["id_presidente"] == $maestro->id) ? 'selected' : '' }}>
                                                {{ $maestro->nombre }} {{ $maestro->apellidos }} | asesorías: {{ $maestro->maestro->asesor_count }} | {{ $maestro->maestro->academia->nombre }}
                                            </option>
                                        @endforeach
                                    @endif
                                </select>
                                @error('presidente')
                                <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">

                            <label class="col-md-4 col-form-label text-md-right" for="opcion">Secretario: </label>
                            <div class="col-md-6">
                                <select class="form-control" id="secretario" name="secretario">
                                    <option value=""  selected>Seleccione profesor</option>
                                    @if(count($maestros) > 0)
                                        @foreach($maestros as $maestro)
                                            <option value="{{ $maestro->maestro->id }}" {{ ($maestro->maestro["asesores"]["id_secretario"] == $maestro->id) ? 'selected' : '' }}>
                                                {{ $maestro->nombre }} {{ $maestro->apellidos }} | asesorías: {{ $maestro->maestro->asesor_count }} | {{ $maestro->maestro->academia->nombre }}
                                            </option>
                                        @endforeach
                                    @endif
                                </select>
                                @error('secretario')
                                <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">

                            <label class="col-md-4 col-form-label text-md-right" for="opcion">Vocal: </label>
                            <div class="col-md-6">
                                <select class="form-control" id="vocal" name="vocal">
                                    <option value=""  selected>Seleccione profesor</option>
                                    @if(count($maestros) > 0)
                                        @foreach($maestros as $maestro)
                                            <option value="{{ $maestro->maestro->id }}" {{ ($maestro->maestro["asesores"]["id_vocal"] == $maestro->id) ? 'selected' : '' }}>
                                                {{ $maestro->nombre }} {{ $maestro->apellidos }} | asesorías: {{ $maestro->maestro->asesor_count }} | {{ $maestro->maestro->academia->nombre }}
                                            </option>
                                        @endforeach
                                    @endif
                                </select>
                                @error('vocal')
                                <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">

                            <label class="col-md-4 col-form-label text-md-right" for="opcion">Vocal Suplente: </label>
                            <div class="col-md-6">
                                <select class="form-control" id="vocal_suplente" name="vocal_suplente">
                                    <option value=""  selected>Seleccione profesor</option>
                                    @if(count($maestros) > 0)
                                        @foreach($maestros as $maestro)
                                            <option value="{{ $maestro->maestro->id }}" {{ ($maestro->maestro["asesores"]["id_vocal_suplente"] == $maestro->id) ? 'selected' : '' }}>
                                                {{ $maestro->nombre }} {{ $maestro->apellidos }} | asesorías: {{ $maestro->maestro->asesor_count }} | {{ $maestro->maestro->academia->nombre }}
                                            </option>
                                        @endforeach
                                    @endif
                                </select>
                                @error('vocal_suplente')
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

        </div>
    </div>
@endsection
