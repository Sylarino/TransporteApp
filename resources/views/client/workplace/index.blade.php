@extends('layouts.main.app')
@section('page-title','Servicios')
@section('page-icon','map-marker')
@section('content')
    {!! makeDefaultView(['Empresa','Servicio','Acciones'],'workplaces') !!}
@endsection
