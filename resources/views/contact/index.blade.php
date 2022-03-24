@extends('layouts.main.app')
@section('page-title','Contactos')
@section('page-icon','address-book')
@section('content')
    {!! makeDefaultView(['Nombre','Apellido','Telefonos','email','direccion','Acciones'],'contacts') !!}
@endsection
