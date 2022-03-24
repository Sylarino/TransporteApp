@extends('layouts.main.app')
@section('page-title','Ingresar Nueva carrera')
@section('page-icon','car')
@section('content')
    @if(!$driver_shift)
        @include('internal.driver.shift-races.shift-form')
    @else
        @include('internal.driver.shift-races.race-form')
    @endif
@endsection
