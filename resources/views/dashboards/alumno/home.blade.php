@extends('layouts.app')

@section('content')
    Dashboard del {{$role->nombre}}

    {{ Auth::user() }}
    <hr>
    {{ $alumno }}
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    Registro de datos del solicitante
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('DivisionEstudios.jefe.update') }}">
                        @csrf
                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right" for="especialidad">Asignado: </label>
                            <div class="col-md-6">
                                <select class="form-control" id="especialidad" name="especialidad" onchange="cargarPlanesDeEstudio(this.value);">
                                    <option value=""  selected>Seleccione especialidad</option>
                                    @if(count($especialidades) > 0)
                                        @foreach($especialidades as $especialidad)
                                            <option value="{{ $especialidad->id }}" {{ ($alumno["id_especialidad"] == $especialidad->id) ? 'selected' : '' }}>{{ $especialidad->nombre }}</option>
                                        @endforeach
                                    @endif
                                </select>
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

    <script >
        function cargarPlanesDeEstudio() {
            alert("plan de estudio");
        }
    </script>
@endsection
