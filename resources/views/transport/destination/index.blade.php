@extends('layouts.main.app')
@section('page-title','Destinos')
@section('page-icon','map-marker-alt')
@section('content')
    {!! makeDefaultView(['Servicio','destino','Acciones'],'destinations') !!}
@endsection
