@extends('layouts.app')

@section('content')
    Dashboard del {{$role->nombre}}

    {{ Auth::user() }}
    <hr>
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
                            <label class="col-md-4 col-form-label text-md-right" for="especialidad">Especialidad: </label>
                            <div class="col-md-6">
                                <select class="form-control" id="especialidad" name="especialidad" onchange="cargarPlanesDeEstudio(this.value);">
                                    <option value=""  selected>Seleccione especialidad</option>
                                    @if(count($especialidades) > 0)
                                        @foreach($especialidades as $especialidad)
                                            <option value="{{ $especialidad->id }}" {{ ($alumno["alumno"]["academia"]["id_especialidad"] == $especialidad->id) ? 'selected' : '' }}>{{ $especialidad->nombre }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>

                        <div class="form-group row" >
                            <label class="col-md-4 col-form-label text-md-right" for="planes">Plan de estudios: </label>
                            <div class="col-md-6">
                                <div id="waiting">
                                </div>
                                <select class="form-control" id="planes" name="planes">


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
        window.onload = function() {
            console.log("Cargando plan de estudio si ya fue seleccionado, en este caso traemos solamente el id de la" +
                "especialidad del alumno si esta existe");
            // cargando plan de estudio si el valor de select de especialidad no viene vacio
            var selectedEspecialidad = $("#especialidad").children('option:selected').val();

            if(selectedEspecialidad !== "") {
                console.log("selected especialidad es: "+ selectedEspecialidad);
            }

        }


        function cargarPlanesDeEstudio(idEspecialidad) {
            //Especialidad.planes -> /Especialidad/planes-de-estudio

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('#waiting').html("<span class='alert alert-info'>Espere en lo que se procesa</span>");

            $.ajax({
                type:'GET',
                url: '/Especialidad/'+idEspecialidad+"/PlanesEstudio",
                success: function(data) {

                    let newData= '<option value=""  selected>Seleccione plan de estudio</option>';

                    data.planes.map((plan) => {
                        newData+= '<option value="'+plan.id+'"  selected>'+plan.clave+'</option>';
                    });
                    $('#planes').html(newData);
                    $('#waiting').html("");
                },
                error: function(error) {
                    console.log(error);
                    $('#waiting').html("<span class='alert alert-danger'>Error al obtener los planes de estudio</span>");
                }
            });
        }
    </script>
@endsection
