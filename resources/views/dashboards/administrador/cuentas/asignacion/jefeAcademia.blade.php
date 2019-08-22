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
                                                <div class="form-group row">
                                                    <label class="col-md-4 col-form-label text-md-right" for="academia">Asignado: </label>
                                                    <div class="col-md-6">
                                                        <select class="form-control" id="academia" name="academia">
                                                            @if(count($academias) > 0)
                                                                <option value="{{ $academias[0]->id }}">{{ $academias[0]->nombre }}</option>
                                                                @foreach ($academias as $academia)
                                                                    @if($academia->id != $academias[0]->id)
                                                                        <option value="{{ $academia->id }}">{{ $academia->nombre }}</option>
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
