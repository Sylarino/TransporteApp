@extends('layouts.main.app')
@section('page-title','Moviles')
@section('page-icon','car')
@section('content')
    {!! makeDefaultView(['Servicio','Movil','Patente','Acciones'],'mobiles') !!}
@endsection
