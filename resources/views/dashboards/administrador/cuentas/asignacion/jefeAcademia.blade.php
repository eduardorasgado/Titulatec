@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10"></div>
            <a class="btn btn-primary" href="/home">Atrás</a>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-8">

                @if(session('success'))
                    <div class="alert alert-success" role="alert" style="margin-top: 5px">
                        <span class="text-success">{{ session('success') }}</span>
                    </div>

                @endif
                @if(session('error'))
                    <div class="alert alert-danger" role="alert" style="margin-top: 5px">
                        <span class="text-success">{{ session('error') }}</span>
                    </div>

                @endif

                <div class="card">
                    <div class="card-header">{{ __('Asignacion de jefes de academia') }}</div>

                    <div class="card-body">
                            @if(count($academias) > 0)
                                @foreach ($academias as $academia)
                                    <div class="card">
                                        <div class="card-header">
                                            Jefe de {{$academia->nombre}}
                                        </div>
                                        <div class="card-body">
                                            <form method="POST" action="{{ route('JefesAcademia.update', $academia->id) }}">
                                                @csrf
                                                @foreach($jefes as $jefe)
                                                    @if($jefe->maestro->academia->id == $academia->id)
                                                        <input type="hidden" name="jefeActual" value="{{ $jefe->id }}">
                                                    @endif
                                                @endforeach
                                                <div class="form-group row">
                                                    <label class="col-md-4 col-form-label text-md-right" for="academia">Asignado: </label>
                                                    <div class="col-md-6">
                                                        <select class="form-control" id="jefe" name="jefe">
                                                            <option value=""  selected>Seleccione jefe antes de guardar</option>
                                                            @if(count($maestros) > 0)
                                                                @foreach($jefes as $jefe)
                                                                    @if($jefe->maestro->academia->id == $academia->id)
                                                                        <option value="{{ $jefe->id }}" selected>{{ $jefe->nombre }} {{ $jefe->apellidos }}</option>
                                                                    @endif
                                                                @endforeach
                                                                @foreach ($maestros as $maestro)
                                                                    @if($maestro->maestro->academia->id == $academia->id)
                                                                        <option value="{{ $maestro->id }}">{{ $maestro->nombre }} {{ $maestro->apellidos }}</option>
                                                                    @endif
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
                                    <br/>
                                @endforeach
                            @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
