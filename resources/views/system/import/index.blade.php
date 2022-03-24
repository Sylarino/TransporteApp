@extends('layouts.main.app')
@section('page-title','Imports')
@section('page-icon','database')
@section('content')
    {!! makeDefaultView(['nombre','slug','descripción','role_necesario','Acciones'],'imports') !!}
@endsection

