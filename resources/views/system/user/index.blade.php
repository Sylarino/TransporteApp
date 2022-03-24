@extends('layouts.main.app')
@section('page-title','Users')
@section('page-icon','users')
@section('content')
    {!! makeDefaultView(['Nombre','apellido','email','Acciones'],'users') !!}
@endsection
