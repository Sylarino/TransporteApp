@extends('layouts.main.app')
@section('page-title','Permisos')
@section('page-icon','th-list')
@section('content')
    {!! makeDefaultView(['Slug','listado','Acciones'],'permissions') !!}
@endsection
