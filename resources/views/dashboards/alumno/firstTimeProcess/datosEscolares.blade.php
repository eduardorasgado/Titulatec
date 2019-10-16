@extends('layouts.app')

@section('content')

    @if(session('Error'))
        <div class="alert alert-danger" role="alert" style="margin-top: 5px">
            <span class="text-success">{{ session('Error') }}</span>
        </div>

    @endif
    <hr>

    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    1. Registro de datos escolares
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
                                <label for="numero_control" class="col-md-4 col-form-label text-md-right">{{ __('Número Control') }}</label>

                                <div class="col-md-6">
                                    <input id="numero_control" type="text" class="form-control @error('numero_control') is-invalid @enderror" name="numero_control" value="{{ $alumno["alumno"]["numero_control"] }}" required autocomplete="numero_control" autofocus>

                                    @error('numero_control')
                                    <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="otherTECNM" class="col-md-4 col-form-label text-md-right">{{ __('En caso de venir de otro TECNM, nombre:') }}</label>

                                <div class="col-md-6">
                                    <input id="otherTECNM" type="text" class="form-control @error('otherTECNM') is-invalid @enderror" name="otherTECNM" value="{{ $alumno["alumno"]["otherTECNM"] }}" autocomplete="otherTECNM" autofocus>

                                    @error('otherTECNM')
                                    <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="generacion" class="col-md-4 col-form-label text-md-right">{{ __('Generación') }}</label>

                                <div class="col-md-6">
                                    <input id="generacion" type="text" class="form-control @error('generacion') is-invalid @enderror" name="generacion" value="{{ $alumno["alumno"]["generacion"] }}" required autocomplete="generacion" autofocus>

                                    @error('generacion')
                                    <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="anexo" class="col-md-4 col-form-label text-md-right">{{ __('Anexo') }}</label>

                                <div class="col-md-6">
                                    <textarea id="anexo" type="text" class="form-control @error('anexo') is-invalid @enderror" name="anexo" autocomplete="anexo" autofocus>{{ $alumno["alumno"]["anexo"] }}
                                    </textarea>

                                    @error('anexo')
                                    <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                    @enderror
                                </div>
                            </div>

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

                                    <select class="form-control" id="plan" name="plan" onchange="filterOpcionTitulacionByRelevance(this.value);">
                                        <!-- render a traves de ajax abajo del file-->
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-md-4 col-form-label text-md-right" for="opcion">Opción de titulación: </label>
                                <div class="col-md-6">
                                    <select class="form-control" id="opcion" name="opcion">
                                        <option value=""  selected>Seleccione opción de titulación</option>
                                        @if(count($opcionesTitulacion) > 0)
                                            @foreach($opcionesTitulacion as $opcion)
                                                <option value="{{ $opcion->id }}" {{ ($procesoTitulacion["id_opcion_titulacion"] == $opcion->id) ? 'selected' : '' }}>{{ $opcion->nombre }}</option>
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

                        <div class="row mx-auto m-md-2">
                            @if(session('success-opcion'))
                                <div class="alert alert-success" role="alert" style="margin-top: 5px">
                                    <span class="text-success">{{ session('success-opcion') }}</span>
                                </div>

                            @endif
                            @if(session('error-opcion'))
                                <div class="alert alert-danger" role="alert" style="margin-top: 5px">
                                    <span class="text-success">{{ session('error-opcion') }}</span>
                                </div>

                            @endif
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('js/jquery.js') }}"></script>
    <script src="{{ asset('js/jquery.steps.js') }}"></script>

    <script type="text/javascript">

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

        $("#example-basic").steps({
            headerTag: "h3",
            bodyTag: "section",
            transitionEffect: "slideLeft",
            autoFocus: true
        });

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
                            newData+= '<option value="{\'id\':'+plan.id+', \'is_actual\':'+plan.is_actual+'}" ';
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
                        $('#waiting').html("<span class='alert alert-danger' style='display: block;'>Error al obtener los planes de estudio</span>");
                    }
                });
            } else {
                $('#plan').html("");
            }
        }

        function filterOpcionTitulacionByRelevance(value) {
            let val = value.replace(/'/g, "\"");
            // el siguiente campo viene con un json de tipo {id:%, is_actual:%}
            // TODO: Separar la parte is_actual convirtiendo a json y en base a eso filtrar todo lo que hay en opcion de titulacion segun la lista de excel
            console.log(val);
        }
    </script>
@endsection
