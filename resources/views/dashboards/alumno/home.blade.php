@extends('layouts.app')

@section('content')
    Dashboard del {{$role->nombre}}
    @if(session('Error'))
        <div class="alert alert-danger" role="alert" style="margin-top: 5px">
            <span class="text-success">{{ session('Error') }}</span>
        </div>

    @endif
    <hr>
    <div class="jumbotron align-content-center">
        <div>
            <h2>Tu proceso actual:</h2>
            <div class="row m-md-4">

                <div class="col-md-2"></div>
                <div class="col-md-10">
                    <span class="badge
                        @if($procesoTitulacion)
                            @if($procesoTitulacion["datos_generales"])
                                badge-success
                            @else
                                badge-secondary
                            @endif
                        @else
                            badge-secondary
                        @endif
                    ">Cargar información</span>
                    ->
                    <span class="badge
                        @if($procesoTitulacion)
                            @if($procesoTitulacion["solicitud_titulacion"])
                                badge-success
                            @else
                                badge-secondary
                            @endif
                        @else
                            badge-secondary
                        @endif
                    ">Solicitud de titulación</span>
                    ->
                    <span class="badge
                        @if($procesoTitulacion)
                            @if($procesoTitulacion["memorandum"])
                                badge-success
                            @else
                                badge-secondary
                            @endif
                        @else
                            badge-secondary
                        @endif
                    ">Memorandum</span>
                    ->
                    <span class="badge badge-secondary
                        @if($procesoTitulacion)
                            @if($procesoTitulacion["registro_proyecto"])
                                badge-success
                            @else
                                badge-secondary
                            @endif
                        @else
                            badge-secondary
                        @endif
                    ">Registro de proyecto</span>
                    ->
                    <span class="badge badge-secondary
                        @if($procesoTitulacion)
                            @if($procesoTitulacion["avisos"])
                                badge-success
                            @else
                                badge-secondary
                            @endif
                        @else
                            badge-secondary
                        @endif
                    ">Avisos</span>
                    ->
                    <span class="badge badge-secondary
                        @if($procesoTitulacion)
                            @if($procesoTitulacion["is_proceso_finished"])
                                badge-success
                            @else
                                badge-secondary
                            @endif
                        @else
                            badge-secondary
                        @endif
                    ">Acta</span>

                </div>
            </div>

            <div class="row">
                <span class="alert alert-info">
                    En caso de haber completado el registro de tus datos y del proyecto, genere su solicitud de titulación y presente ante División de Estudios Profesionales.
                </span>
            </div>
            <div class="row">
                <div class="col-md-8"></div>
                <div class="col-md-4">
                    <a href="{{ route('SolicitudTitulacion.generate', $alumno["alumno"]["id"]) }}" target="_blank"><button type="button"
                                        onclick="messaging()"
                                       class="btn
                                           @if(!$registroCompletado)
                                           btn-danger
                                           @else
                                           btn-success
                                           @endif
                            "
                        @if(!$registroCompletado)
                            disabled
                        @endif
                        >
                            Generar solicitud de titulación.
                        </button>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="jumbotron jumbo-1 text-center">
                <a href="{{ route('Alumno.Datos.Modificar', $alumno["alumno"]["id"]) }}" class="btn btn-outline-primary">Modificar datos</a>
            </div>
        </div>
        <div class="col-md-6">
            <div class="jumbotron jumbo-1 text-center">
                <a href="{{ route('User.edit') }}" class="btn btn-outline-primary">Cambiar datos de acceso a cuenta</a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    Datos Escolares
                </div>
                <div class="card-body">
                    <div class="row mx-auto">
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
                                    <input id="numero_control" type="text" class="form-control @error('numero_control') is-invalid @enderror" name="numero_control" value="{{ $alumno["alumno"]["numero_control"] }}" required autocomplete="numero_control" autofocus
                                           disabled>

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
                                    <input id="otherTECNM" type="text" class="form-control @error('otherTECNM') is-invalid @enderror" name="otherTECNM" value="{{ $alumno["alumno"]["otherTECNM"] }}" autocomplete="otherTECNM" autofocus
                                           disabled>

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
                                    <input id="generacion" type="text" class="form-control @error('generacion') is-invalid @enderror" name="generacion" value="{{ $alumno["alumno"]["generacion"] }}" required autocomplete="generacion" autofocus
                                           disabled>

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
                                    <textarea id="anexo" type="text" class="form-control @error('anexo') is-invalid @enderror" name="anexo" autocomplete="anexo" autofocus disabled>{{ $alumno["alumno"]["anexo"] }}
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
                                    <select class="form-control" id="especialidad" name="especialidad" onchange="cargarPlanesDeEstudio(this.value);" disabled>
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

                                    <select class="form-control" id="plan" name="plan" disabled>
                                        <!-- render a traves de ajax abajo del file-->
                                    </select>
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
                        <form method="POST" action="{{ route('ProcesoTitulacion.store') }}">
                            @csrf

                            <input type="hidden"value="{{ $alumno->alumno->id }}" name="idAlumno" id="idAlumno">
                            <div class="form-group row">


                                <label class="col-md-4 col-form-label text-md-right" for="opcion">Opción de titulación: </label>
                                <div class="col-md-6">
                                    <select class="form-control" id="opcion" name="opcion" disabled>
                                        <option value=""  selected>Seleccione opción de titulación</option>
                                        @if(count($opcionesTitulacion) > 0)
                                            @foreach($opcionesTitulacion as $opcion)
                                                <option value="{{ $opcion->id }}" {{ ($procesoTitulacion["id_opcion_titulacion"] == $opcion->id) ? 'selected' : '' }}>{{ $opcion->nombre }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>

                        </form>
                    </div>

                </div>
            </div>
            <br>
            <div class="card">
                <div class="card-header">
                    Proyecto de alumno
                </div>

                @if($proyecto != null)
                    <div class="row mx-auto m-md-2">
                        @if(session('success-verification'))
                            <div class="alert alert-success" role="alert" style="margin-top: 5px">
                                <span class="text-success">{{ session('success-verification') }}</span>
                            </div>

                        @endif
                        @if(session('error-verification'))
                            <div class="alert alert-danger" role="alert" style="margin-top: 5px">
                                <span class="text-success">{{ session('error-verification') }}</span>
                            </div>

                        @endif
                    </div>
                    <div class="card-body">
                        <p>Nombre: <span class="blue">{{ $proyecto["nombre"] }}</span></p>
                        <p>Producto: <span class="blue">{{ $proyecto["producto"] }}</span></p>
                        <p>Número de integrantes: <span class="blue">{{ $proyecto["num_total_integrantes"] }}</span></p>

                        @if($proyecto["num_total_integrantes"] > 1)
                            <p hidden>Integrantes registrados: <span class="blue">{{ $proyecto["conteo_registrados"] }}</span></p>
                            <span hidden class="alert alert-info">Código para compartir: <span class="blue">{{ $proyecto["codigo_compartido"] }}</span></span>
                        @endif
                        <div class="row">
                            <div class="col-md-8"></div>
                            <div class="col-md-4" hidden>
                                @if($proyecto["id_creador"] == $alumno["alumno"]["id"])
                                    <a href="{{ Route('Proyecto.edit', ['Proyecto' => $proyecto->id]) }}">
                                        <button class="btn btn-outline-danger"
                                        >Editar Proyecto</button></a>
                                @endif
                            </div>
                        </div>
                    </div>
                @else
                    <div class="card-body">
                        <div id="init-proyect" class="row">
                            <div class="col-md-4">
                            <span class="" style="font-size: 9px; padding:0; margin:0">
                                Para crear un nuevo proyecto, ten en cuenta que si el proyecto es entre varios integrantes, vas a ser el responsable de rellenar correctamente todos los datos del proyecto.
                            </span>
                                <a href="{{ route('Proyecto.create') }}"><button class="btn btn-outline-primary">Crear Proyecto</button></a>
                            </div>
                            <div class="col-md-8">
                            <span class="" style="font-size: 9px; padding:0; margin:0">
                                En caso de tener un equipo, el primero en haber creado el proyecto en el sistema, debe de proporcionarte el siguiente código.
                            </span>
                                <div class="row mx-auto">
                                    @if(session('error-verification'))
                                        <div class="alert alert-danger" role="alert" style="margin-top: 5px">
                                            <span class="text-success">{{ session('error-verification') }}</span>
                                        </div>

                                    @endif
                                </div>
                                <form hidden method="POST" action="{{ route('Alumno.verificar.codigo', $alumno["alumno"]["id"]) }}">
                                    @csrf
                                    <div class="form-group row">
                                        <label for="direccion" class="col-md-4 col-form-label text-md-right">{{ __('Código de proyecto') }}</label>

                                        <div class="col-md-6">
                                            <input id="codigo" type="text" class="form-control @error('codigo') is-invalid @enderror" name="codigo" value="{{ old('codigo') }}" required autocomplete="codigo" autofocus
                                            >

                                            @error('codigo')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row mb-0">
                                        <div class="col-md-6 offset-md-4">
                                            <button type="submit" class="btn btn-primary">
                                                {{ __('Cargar proyecto') }}
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div id="existing-project">
                            <input type="hidden" value="{{ $alumno["proyecto"]["id"] }}">
                        </div>
                    </div>
                @endif

            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    Datos Personales
                </div>
                <div class="card-body">
                    <div class="row mx-auto">

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
                                    <input id="direccion" type="text" class="form-control @error('direccion') is-invalid @enderror" name="direccion" value="{{ $alumno["alumno"]["direccion"] }}" required autocomplete="direccion" autofocus
                                           disabled>

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
                                    <input id="telefono" type="text" class="form-control @error('telefono') is-invalid @enderror" name="telefono" value="{{ $alumno["alumno"]["telefono"] }}" required autocomplete="telefono" autofocus
                                           disabled>

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
                                    <select class="form-control" id="estado" name="estado" disabled>
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
                                    <input id="ciudad" type="text" class="form-control @error('ciudad') is-invalid @enderror" name="ciudad" value="{{ $alumno["alumno"]["ciudad"] }}" required autocomplete="ciudad" autofocus
                                           disabled>

                                    @error('ciudad')
                                    <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                    @enderror
                                </div>
                            </div>


                        </form>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    Datos Profesionales
                </div>
                <div class="card-body">
                    <div class="row mx-auto">

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
                                <label for="lugar_trabajo" class="col-md-4 col-form-label text-md-right">{{ __('Lugar de trabajo') }}</label>

                                <div class="col-md-6">
                                    <input id="lugar_trabajo" type="text" class="form-control @error('lugar_trabajo') is-invalid @enderror" name="lugar_trabajo" value="{{ $alumno["alumno"]["lugar_trabajo"] }}" autocomplete="lugar_trabajo" autofocus
                                           disabled>

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
                                    <input id="puesto_trabajo" type="text" class="form-control @error('puesto_trabajo') is-invalid @enderror" name="puesto_trabajo" value="{{ $alumno["alumno"]["puesto_trabajo"] }}" autocomplete="puesto_trabajo" autofocus
                                           disabled>

                                    @error('puesto_trabajo')
                                    <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                    @enderror
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>



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
        };

        function messaging() {
            alert("Listo! Se va a generar una solicitud de titulación. El siguiente paso es acudir con este documento al departamento de división de estudios profesionales. Junto a los demás documentos necesarios.");
            setTimeout(function () {
                location.reload();
            }, 5000);
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
                        $('#waiting').html("<span class='alert alert-danger' style='display: block;'>Error al obtener los planes de estudio</span>");
                    }
                });
            } else {
                $('#plan').html("");
            }
        }
    </script>
@endsection
