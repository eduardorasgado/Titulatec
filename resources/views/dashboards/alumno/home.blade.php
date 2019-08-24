@extends('layouts.app')

@section('content')
    Dashboard del {{$role->nombre}}
    <hr>
    <div class="jumbotron align-content-center">
        <div>
            <h2>Tu proceso actual:</h2>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    Registro de datos de carrera
                </div>
                <div class="card-body">
                    <div class="row mx-auto">
                        <span class="alert alert-info">Atención: una vez iniciado el proceso de papeleo, ya no es posible cambiar la carrera</span>
                        @if(session('success-especialidad'))
                            <div class="alert alert-success" role="alert" style="margin-top: 5px">
                                <span class="text-success">{{ session('success-especialidad') }}</span>
                            </div>

                        @endif
                        @if(session('error-especialidad'))
                            <div class="alert alert-danger" role="alert" style="margin-top: 5px">
                                <span class="text-success">{{ session('error-especialidad') }}</span>
                            </div>

                        @endif
                    </div>
                    <div class="jumbotron">
                        <form method="POST" action="{{ route('AlumnoCarrera.update', ['AlumnoCarrera' => $alumno["alumno"]["id"]]) }}">
                            {{ method_field('PUT') }}
                            @csrf
                            <div class="form-group row">
                                <input type="hidden" id="planActual" value="{{ $alumno["alumno"]["carrera"]["id_plan_estudios"] }}">
                                <label class="col-md-4 col-form-label text-md-right" for="especialidad">Especialidad: </label>
                                <div class="col-md-6">
                                    <select class="form-control" id="especialidad" name="especialidad" onchange="cargarPlanesDeEstudio(this.value);">
                                        <option value=""  selected>Seleccione especialidad</option>
                                        @if(count($especialidades) > 0)
                                            @foreach($especialidades as $especialidad)
                                                <option value="{{ $especialidad->id }}" {{ ($alumno["alumno"]["carrera"]["id_especialidad"] == $especialidad->id) ? 'selected' : '' }}>{{ $especialidad->nombre }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                                <div id="waiting" class="col-md-1">

                                </div>
                            </div>
                            <div class="form-group row" >
                                <label class="col-md-4 col-form-label text-md-right" for="plan">Plan de estudios: </label>
                                <div class="col-md-6">

                                    <select class="form-control" id="plan" name="plan">
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
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    Registro de datos del alumno
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
                        <form method="POST" action="{{ route('AlumnoCarrera.update', ['AlumnoCarrera' => $alumno["alumno"]["id"]]) }}">
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
                                    <input id="telefono" type="text" class="form-control @error('telefono') is-invalid @enderror" name="telefono" value="{{ $alumno["alumno"]["telefono"] }}" required autocomplete="telefono" autofocus>

                                    @error('telefono')
                                    <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="otherTECNM" class="col-md-4 col-form-label text-md-right">{{ __('En caso de venir de otro TECNM, nombre:') }}</label>

                                <div class="col-md-6">
                                    <input id="otherTECNM" type="text" class="form-control @error('otherTECNM') is-invalid @enderror" name="otherTECNM" value="{{ $alumno["alumno"]["otherTECNM"] }}" required autocomplete="otherTECNM" autofocus>

                                    @error('otherTECNM')
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

    <script >
        window.onload = function() {
            //Cargando plan de estudio si ya fue seleccionado, en este caso traemos solamente el id de la especialidad del alumno si esta existe
            // cargando plan de estudio si el valor de select de especialidad no viene vacio
            var selectedEspecialidad = $("#especialidad").children('option:selected').val();
            var planActualSelected = $("#planActual").val();

            if(selectedEspecialidad !== "") {
                if(planActualSelected === "") {
                    planActualSelected = 0;
                }
                cargarPlanesDeEstudio(selectedEspecialidad, parseInt(planActualSelected));
            }
        }


        function cargarPlanesDeEstudio(idEspecialidad, idPlanActual = 0) {
            //Especialidad.planes -> /Especialidad/planes-de-estudio

            if(idEspecialidad !== "") {
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

                        let newData= '<option value="" >Seleccione plan de estudio</option>';

                        data.planes.map((plan) => {
                            newData+= '<option value="'+plan.id+'" ';
                            // en caso de que ya exista el plan actual en la db
                            if(idPlanActual !== 0 && idPlanActual === parseInt(plan.id)) {
                                newData+= 'selected';
                            }
                            newData +=' >'+plan.clave+'</option>';
                        });
                        $('#plan').html(newData);
                        $('#waiting').html("");
                    },
                    error: function(error) {
                        console.log(error);
                        $('#waiting').html("<span class='alert alert-danger'>Error al obtener los planes de estudio</span>");
                    }
                });
            } else {
                $('#plan').html("");
            }
        }
    </script>
@endsection
