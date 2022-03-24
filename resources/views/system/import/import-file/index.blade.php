@extends('layouts.main.app')
@section('page-title','Import: '.$import->name)
@section('page-icon','upload')
@section('content')
    {!! makeLink('/getImports','Volver','fa-arrow-left','btn-info') !!}
	{!! makeRemoteLink('/importFile/'.$import->slug.'/upload','Subir Archivo','fa-upload') !!}
	{!! makeDefaultView(['Usuario','Archivo','extensión','Status','Subido el','Acciones'],'import-files/'.$import->slug) !!}
@endsection

