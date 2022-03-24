@extends('layouts.main.app')
@section('page-title','Conductores')
@section('page-icon','users')
@section('content')
    {!! makeDefaultView(['rut','Nombre','apellido','email','Acciones'],'drivers') !!}
@endsection
