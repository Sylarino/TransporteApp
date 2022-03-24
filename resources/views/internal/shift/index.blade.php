@extends('layouts.main.app')
@section('page-title','Turnos')
@section('page-icon','clock')
@section('content')
    {!! makeDefaultView(['Hora Inicio','Hora Termino','Nombre','Acciones'],'shifts') !!}
@endsection
