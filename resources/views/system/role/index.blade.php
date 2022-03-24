@extends('layouts.main.app')
@section('page-title','Role')
@section('page-icon','key')
@section('content')
	{!! makeDefaultView(['Slug','Nombre','Acciones'],'roles') !!}
@endsection
