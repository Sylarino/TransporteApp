@extends('layouts.main.app')
@section('page-title','Menu')
@section('page-icon','bars')
@section('content')
    @if(Sentinel::getUser()->hasAccess('menus.serialize'))
        {!! makeRemoteLink('/menuSerialization','Serializar','fa-list-ol','btn-primary','') !!}
    @endif
    {!! makeDefaultView(['icono','nombre','ruta','posicion','parent','Acciones'],'menus') !!}
@endsection

