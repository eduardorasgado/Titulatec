@extends('layouts.app')

@section('content')
    Dashboard de {{$role->nombre}}
    <div>
        <p>Bienvenid@ a tu dashboard. Esta es tu mesa de trabajo, ya puedes comenzar a
            utilizarla. Excelente día</p>
    </div>


    <div class="container">
        @if(Session::has('Error'))
            <div class="alert alert-warning" role="alert" style="margin-top: 5px">
                <span class="text-success">{{ Session::get('Error') }}</span>
            </div>
        @endif
        <div class="row">
            <div class="col-md-6">
                <div class="jumbotron jumbo-1 text-center">

                    <a href="{{ route('Acta.index') }}">
                        <button type="button" class="btn btn-success">
                            Administración de Actas
                        </button>
                    </a>
                </div>
            </div>

            <div class="col-md-6">
                <div class="jumbotron jumbo-2 text-center">
                    <div class="dropdown">
                        <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown">
                            Libros
                        </button>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="{{ route('Libros.create') }}">Agregar libro</a>
                            <a class="dropdown-item" href="{{ route('Libros.index') }}">Ver libros</a>
                        d</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="jumbotron col-md-6 text-center jumbo-2">
                <a href="#multiCollapse1" class="btn btn-primary" data-toggle="collapse"
                   role="button" aria-expanded="false" aria-controls="multiCollapse1">
                    Desplegar Informe de actas
                </a>&nbsp;&nbsp;
            </div>

                <div class="">
                <div class="collapse multi-collapse" id="multiCollapse1">
                    <div class="card card-header">
                        Informe de actas
                    </div>
                    <div class="card card-body">

                        <div class="row">
                            <p><span class="badge badge-primary"></span>Por academias(por mes)</p>
                            <table class="tg table table-bordered" style="border-collapse: collapse !important;">
                                <thead>
                                <tr>
                                    <th scope="col"><p class="shorter" align="center">Areas</p></th>
                                    <th scope="col"><p class="shorter" align="center">Enero</p></th>
                                    <th scope="col"><p class="shorter" align="center">Febrero</p></th>
                                    <th scope="col"><p class="shorter" align="center">Marzo</p></th>
                                    <th scope="col"><p class="shorter" align="center">Abril</p></th>
                                    <th scope="col"><p class="shorter" align="center">Mayo</p></th>
                                    <th scope="col"><p class="shorter" align="center">Junio</p></th>
                                    <th scope="col"><p class="shorter" align="center">Julio</p></th>
                                    <th scope="col"><p class="shorter" align="center">Agosto</p></th>
                                    <th scope="col"><p class="shorter" align="center">Septiembre</p></th>
                                    <th scope="col"><p class="shorter" align="center">Octubre</p></th>
                                    <th scope="col"><p class="shorter" align="center">Noviembre</p></th>
                                    <th scope="col"><p class="shorter" align="center">Diciembre</p></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($academias as $academia)
                                    <tr>
                                        <th scope="col">{{ $academia->nombre }}</th>
                                        <td  scope="col">
                                            <?php $p = 0;
                                             $np = 0; ?>
                                            @foreach($actas_enero as $acta)
                                                @if($acta->procesoTitulacion->alumno->carrera->especialidad->academia->id == $academia->id)
                                                    @if($acta->foja != null)
                                                        <?php $p++; ?>
                                                    @else
                                                        <?php $np++; ?>
                                                    @endif
                                                @endif
                                            @endforeach
                                            P: <span style="font-weight: bold;" >{{ $p }}</span> / NP: {{ $np }}
                                        </td>
                                        <td  scope="col">
                                            <?php $p = 0;
                                            $np = 0; ?>
                                            @foreach($actas_febrero as $acta)
                                                @if($acta->procesoTitulacion->alumno->carrera->especialidad->academia->id == $academia->id)
                                                    @if($acta->foja != null)
                                                        <?php $p++; ?>
                                                    @else
                                                        <?php $np++; ?>
                                                    @endif
                                                @endif
                                            @endforeach
                                                P: <span style="font-weight: bold;" >{{ $p }}</span> / NP: {{ $np }}
                                        </td>
                                        <td  scope="col">
                                            <?php $p = 0;
                                            $np = 0; ?>
                                            @foreach($actas_marzo as $acta)
                                                @if($acta->procesoTitulacion->alumno->carrera->especialidad->academia->id == $academia->id)
                                                    @if($acta->foja != null)
                                                        <?php $p++; ?>
                                                    @else
                                                        <?php $np++; ?>
                                                    @endif
                                                @endif
                                            @endforeach
                                                P: <span style="font-weight: bold;" >{{ $p }}</span> / NP: {{ $np }}
                                        </td>
                                        <td  scope="col">
                                            <?php $p = 0;
                                            $np = 0; ?>
                                            @foreach($actas_abril as $acta)
                                                @if($acta->procesoTitulacion->alumno->carrera->especialidad->academia->id == $academia->id)
                                                    @if($acta->foja != null)
                                                        <?php $p++; ?>
                                                    @else
                                                        <?php $np++; ?>
                                                    @endif
                                                @endif
                                            @endforeach
                                                P: <span style="font-weight: bold;" >{{ $p }}</span> / NP: {{ $np }}
                                        </td>
                                        <td  scope="col">
                                            <?php $p = 0;
                                            $np = 0; ?>
                                            @foreach($actas_mayo as $acta)
                                                @if($acta->procesoTitulacion->alumno->carrera->especialidad->academia->id == $academia->id)
                                                    @if($acta->foja != null)
                                                        <?php $p++; ?>
                                                    @else
                                                        <?php $np++; ?>
                                                    @endif
                                                @endif
                                            @endforeach
                                                P: <span style="font-weight: bold;" >{{ $p }}</span> / NP: {{ $np }}
                                        </td>
                                        <td  scope="col">
                                            <?php $p = 0;
                                                  $np = 0; ?>
                                            @foreach($actas_junio as $acta)
                                                @if($acta->procesoTitulacion->alumno->carrera->especialidad->academia->id == $academia->id)
                                                    @if($acta->foja != null)
                                                        <?php $p++; ?>
                                                    @else
                                                        <?php $np++; ?>
                                                    @endif
                                                @endif
                                            @endforeach
                                                P: <span style="font-weight: bold;" >{{ $p }}</span> / NP: {{ $np }}
                                        </td>
                                        <td  scope="col">
                                            <?php $p = 0;
                                            $np = 0; ?>
                                            @foreach($actas_julio as $acta)
                                                @if($acta->procesoTitulacion->alumno->carrera->especialidad->academia->id == $academia->id)
                                                    @if($acta->foja != null)
                                                        <?php $p++; ?>
                                                    @else
                                                        <?php $np++; ?>
                                                    @endif
                                                @endif
                                            @endforeach
                                                P: <span style="font-weight: bold;" >{{ $p }}</span> / NP: {{ $np }}
                                        </td>
                                        <td  scope="col">
                                            <?php $p = 0;
                                            $np = 0; ?>
                                            @foreach($actas_agosto as $acta)
                                                @if($acta->procesoTitulacion->alumno->carrera->especialidad->academia->id == $academia->id)
                                                    @if($acta->foja != null)
                                                        <?php $p++; ?>
                                                    @else
                                                        <?php $np++; ?>
                                                    @endif
                                                @endif
                                            @endforeach
                                                P: <span style="font-weight: bold;" >{{ $p }}</span> / NP: {{ $np }}
                                        </td>
                                        <td  scope="col">
                                            <?php $p = 0;
                                            $np = 0; ?>
                                            @foreach($actas_septiembre as $acta)
                                                @if($acta->procesoTitulacion->alumno->carrera->especialidad->academia->id == $academia->id)
                                                    @if($acta->foja != null)
                                                        <?php $p++; ?>
                                                    @else
                                                        <?php $np++; ?>
                                                    @endif
                                                @endif
                                            @endforeach
                                                P: <span style="font-weight: bold;" >{{ $p }}</span> / NP: {{ $np }}
                                        </td>
                                        <td  scope="col">
                                            <?php $p = 0;
                                            $np = 0; ?>
                                            @foreach($actas_octubre as $acta)
                                                @if($acta->procesoTitulacion->alumno->carrera->especialidad->academia->id == $academia->id)
                                                    @if($acta->foja != null)
                                                        <?php $p++; ?>
                                                    @else
                                                        <?php $np++; ?>
                                                    @endif
                                                @endif
                                            @endforeach
                                                P: <span style="font-weight: bold;" >{{ $p }}</span> / NP: {{ $np }}
                                        </td>
                                        <td  scope="col">
                                            <?php $p = 0;
                                                $np = 0; ?>
                                            @foreach($actas_noviembre as $acta)
                                                @if($acta->procesoTitulacion->alumno->carrera->especialidad->academia->id == $academia->id)
                                                    @if($acta->foja != null)
                                                        <?php $p++; ?>
                                                    @else
                                                        <?php $np++; ?>
                                                    @endif
                                                @endif
                                            @endforeach
                                                P: <span style="font-weight: bold;" >{{ $p }}</span> / NP: {{ $np }}
                                        </td>
                                        <td  scope="col">
                                            <?php $p = 0;
                                            $np = 0; ?>
                                            @foreach($actas_diciembre as $acta)
                                                @if($acta->procesoTitulacion->alumno->carrera->especialidad->academia->id == $academia->id)
                                                    @if($acta->foja != null)
                                                        <?php $p++; ?>
                                                    @else
                                                        <?php $np++; ?>
                                                    @endif
                                                @endif
                                            @endforeach
                                                P: <span style="font-weight: bold;" >{{ $p }}</span> / NP: {{ $np }}
                                        </td>
                                    </tr>
                                @endforeach

                                </tbody>
                            </table>
                            <p>P: Procesados. NP: No procesados</p>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <h5>Información del usuario</h5>
        <div class="row">
            <div class="col-md-6">
                <div class="jumbotron jumbo-1 text-center">
                    <a href="{{ route('User.edit') }}">
                        <button class="btn btn-outline-secondary">Cambiar datos de acceso a cuenta</button></a>
                </div>
            </div>
        </div>
    </div>

@endsection
