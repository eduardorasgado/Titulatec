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
                    <div class="row mx-auto">
                        <span class="alert alert-info">Atención: una vez iniciado el proceso de papeleo, ya no es posible cambiar la carrera</span>
                    </div>
                    <form method="POST" action="{{ route('AlumnoCarrera.update', ['AlumnoCarrera' => $alumno->id]) }}">
                        {{ method_field('PUT') }}
                        @csrf
                        <div class="form-group row">
                            <input type="hidden" id="planActual" value="{{ $alumno["alumno"]["academia"]["id_plan_estudios"] }}">
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
                            <div id="waiting" class="col-md-1">

                            </div>
                        </div>
                        <div class="form-group row" >
                            <label class="col-md-4 col-form-label text-md-right" for="planes">Plan de estudios: </label>
                            <div class="col-md-6">

                                <select class="form-control" id="planes" name="planes">
                                    <!-- render a traves de ajax abajo del file-->
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
            //Cargando plan de estudio si ya fue seleccionado, en este caso traemos solamente el id de la especialidad del alumno si esta existe
            // cargando plan de estudio si el valor de select de especialidad no viene vacio
            var selectedEspecialidad = $("#especialidad").children('option:selected').val();
            var planActualSelected = $("#planActual").val();
            console.log(planActualSelected);

            if(selectedEspecialidad !== "") {
                console.log("selected especialidad es: "+ selectedEspecialidad);
                cargarPlanesDeEstudio(selectedEspecialidad);
            }
        }


        function cargarPlanesDeEstudio(idEspecialidad) {
            //Especialidad.planes -> /Especialidad/planes-de-estudio

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('#waiting').html('<img align="right" width="30" src="{{ asset("images/45.gif") }}"></img>');

            $.ajax({
                type:'GET',
                url: '/Especialidad/'+idEspecialidad+"/PlanesEstudio",
                success: function(data) {

                    let newData= '<option value=""  selected>Seleccione plan de estudio</option>';

                    data.planes.map((plan) => {
                        newData+= '<option value="'+plan.id+'">'+plan.clave+'</option>';
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
