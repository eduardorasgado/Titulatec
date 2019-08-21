@extends('layouts.app')

@section('content')
    Dashboard del {{$role->nombre}}

    {{ Auth::user() }}
    <hr>
    {{ $alumno }}
@endsection
