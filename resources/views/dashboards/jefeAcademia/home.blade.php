@extends('layouts.app')

@section('content')
    Dashboard del {{$role->nombre}}
    tambien del maestro, en este caso, será desactivadas las funciones avanzadas
    <br/>
    @if($role->id == $roleJefeAcademia)
            saldnfaslnvlkdsankn
        @else
            sddddd
    @endif

@endsection
