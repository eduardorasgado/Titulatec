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

        <h5>Informe de actas</h5>
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
                        <td  scope="col">{{ $academia->nombre }}</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                @endforeach

                </tbody>
            </table>
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
