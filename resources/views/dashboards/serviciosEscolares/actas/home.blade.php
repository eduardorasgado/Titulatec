@extends('layouts.app')

@section('content')
    <h2>Administración de Actas</h2>
    <div class="row">
        <div class="col-md-10">
            @if(Session::has('Error'))
                <div class="alert alert-danger" role="alert" style="margin-top: 5px">
                    <span class="text-success">{{ Session::get('Error') }}</span>
                </div>
            @endif
        </div>
        <a class="btn btn-primary" href="/home">Atrás</a>
    </div>
    <div class="row">
        <div class="col-md-6 jumbotron">
        <i class="fas fa-h2    ">Buscador de Actas, buscar por numero de control</i>
            <form action="{{ route('Actas.busqueda') }}" method="POST" role="search">
                {{ csrf_field() }}
                <div class="input-group">
                    
                    <input type="text" class="form-control" name="control"
                        placeholder="Buscar por número de control" required> <span class="input-group-btn">
                        <button type="submit" class="btn btn-primary">Buscar</button>
                    </span>
                </div>
            </form>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <h3>No Generadas</h3>
            @foreach($alumnosSinActas as $alumno)
                <div class="jumboColorBlue">
                    <p>Alumno: <span class="blue">{{ $alumno->nombre }} {{ $alumno->apellidos }}</span></p>
                    <p>Num. Control: <span class="blue">{{ $alumno["alumno"]["numero_control"] }}</span></p>
                    <p>fecha de protocolo: <span class="blue">{{ $alumno["alumno"]["procesoTitulacion"]["acta"]["fecha_examen_aviso"] }}</span></p>
                    <p>hora de inicio de protocolo: <span class="blue">{{ $alumno["alumno"]["procesoTitulacion"]["acta"]["hora_inicio"] }} horas</span></p>
                    <div class="row">
                        <div class="col-md-8"></div>
                        <div class="col-md-2">
                            <a href="{{ route('Acta.show',['Acta' => $alumno["alumno"]["procesoTitulacion"]["acta"]["id"]]) }}"><button class="btn btn-primary">Generar Acta</button></a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="col-md-6">
            <h3>Generadas</h3>
            @foreach($alumnosConActas as $alumno)
                <div class="jumboColorBlue">
                    <p>Alumno: <span class="blue">{{ $alumno->nombre }} {{ $alumno->apellidos }}</span></p>
                    <p>Num. Control: <span class="blue">{{ $alumno["alumno"]["numero_control"] }}</span></p>
                    <p>fecha de protocolo: <span class="blue">{{ $alumno["alumno"]["procesoTitulacion"]["acta"]["fecha_examen_aviso"] }}</span></p>
                    <p>hora de inicio de protocolo: <span class="blue">{{ $alumno["alumno"]["procesoTitulacion"]["acta"]["hora_inicio"] }} horas</span></p>
                    <div class="row">
                        <div class="col-md-8"></div>
                        <div class="col-md-2">
                            <a href="{{ route('Acta.show', ['Acta' => $alumno["alumno"]["procesoTitulacion"]["acta"]["id"]]) }}" target="_blank"><button class="btn btn-primary">Volver a Generar Acta</button></a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
