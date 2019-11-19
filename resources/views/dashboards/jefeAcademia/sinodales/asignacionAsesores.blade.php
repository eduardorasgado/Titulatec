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
                    <div class="row">
                        <div class="col-md-6">
                            @if(Session::has('Error'))
                                <div class="alert alert-danger" role="alert" style="margin-top: 5px">
                                    <span class="text-success">{{ Session::get('Error') }}</span>
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
                    <form method="POST" action="{{ route('Sinodalia.new', [$idAcademia, $idAlumno]) }}"
                        onsubmit="return preGuardar()"
                    >
                        @csrf

                        <input type="hidden"value="{{ $alumno->alumno->id }}" name="idAlumno" id="idAlumno">
                        <div class="form-group row">

                            <label class="col-md-4 col-form-label text-md-right" for="opcion">Presidente: </label>
                            <div class="col-md-6">
                                <select class="form-control" id="presidente" name="presidente"
                                >
                                    <option value=""  selected>Seleccione profesor</option>
                                    @if(count($maestros) > 0)
                                        @foreach($maestros as $maestro)
                                            @if($maestro->is_enable)
                                                <option value="{{ $maestro->maestro->id }}" {{ ($alumno["alumno"]["procesoTitulacion"]["asesores"]["id_presidente"] == $maestro->maestro->id) ? 'selected' : '' }}>
                                                    {{ $maestro->nombre }} {{ $maestro->apellidos }} | asesorías: {{ $maestro->maestro->asesor_count }} | {{ $maestro->maestro->academia->nombre }}
                                                </option>
                                            @endif
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
                                <select class="form-control" id="secretario" name="secretario"
                                >
                                    <option value=""  selected>Seleccione profesor</option>
                                    @if(count($maestros) > 0)
                                        @foreach($maestros as $maestro)
                                            @if($maestro->is_enable)
                                                <option value="{{ $maestro->maestro->id }}" {{ ($alumno["alumno"]["procesoTitulacion"]["asesores"]["id_secretario"] == $maestro->maestro->id) ? 'selected' : '' }}>
                                                    {{ $maestro->nombre }} {{ $maestro->apellidos }} | asesorías: {{ $maestro->maestro->asesor_count }} | {{ $maestro->maestro->academia->nombre }}
                                                </option>
                                            @endif
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
                                <select class="form-control" id="vocal" name="vocal"
                                >
                                    <option value=""  selected>Seleccione profesor</option>
                                    @if(count($maestros) > 0)
                                        @foreach($maestros as $maestro)
                                            @if($maestro->is_enable)
                                                <option value="{{ $maestro->maestro->id }}" {{ ($alumno["alumno"]["procesoTitulacion"]["asesores"]["id_vocal"] == $maestro->maestro->id) ? 'selected' : '' }}>
                                                    {{ $maestro->nombre }} {{ $maestro->apellidos }} | asesorías: {{ $maestro->maestro->asesor_count }} | {{ $maestro->maestro->academia->nombre }}
                                                </option>
                                            @endif
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
                                <select class="form-control" id="vocal_suplente" name="vocal_suplente"
                                >
                                    <option value=""  selected>Seleccione profesor</option>
                                    @if(count($maestros) > 0)
                                        @foreach($maestros as $maestro)
                                            @if($maestro->is_enable)
                                                <option value="{{ $maestro->maestro->id }}" {{ ($alumno["alumno"]["procesoTitulacion"]["asesores"]["id_vocal_suplente"] == $maestro->maestro->id) ? 'selected' : '' }}>
                                                    {{ $maestro->nombre }} {{ $maestro->apellidos }} | asesorías: {{ $maestro->maestro->asesor_count }} | {{ $maestro->maestro->academia->nombre }}
                                                </option>
                                            @endif
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
                                <button id="guardar" type="submit" class="btn btn-primary">
                                    {{ __('Guardar') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h4>Disponibilidad de catedráticos</h4>
                </div>
                <div class="card-body">
                    @if(count($maestros) > 0)
                        @foreach($maestros as $maestro)
                            @if($maestro->is_enable)
                                <p style="margin: 2px"><span class="blue">
                                        {{ $maestro->nombre }} {{ $maestro->apellidos }} <span class="badge badge-success" style="font-size: 1vw">
                                     asesorías: {{ $maestro->maestro->asesor_count }}
                                </span></p>
                            @endif
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>

    <script>

        function preGuardar() {
            let presidente = document.getElementById('presidente').value;
            let secretario = document.getElementById('secretario').value;
            let vocal = document.getElementById('vocal').value;
            let vocalSuplente = document.getElementById('vocal_suplente').value;

            if( presidente != "" && secretario != "" && vocal != "" && vocalSuplente != "") {
                if(presidente === secretario || presidente === vocal || presidente === vocalSuplente
                    || secretario === vocal || secretario === vocalSuplente
                    || vocal === vocalSuplente) {
                    alert("Ningun profesor puede ser elegido dos veces como asesor del mismo alumno");
                    return false;
                }
                return true
            }
            alert("No se han seleccionado todos los asesores");
            return false;
        }
    </script>
@endsection
