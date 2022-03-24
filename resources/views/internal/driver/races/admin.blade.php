@extends('layouts.main.app')
@section('page-title','Listado de transportes realizados')
@section('page-icon','users')
@section('content')
    {!! makeLink('/allTransports/export','Exportar a Excel','fa-file-excel','btn-success','btn-md') !!}
    {!! makeDefaultView([
            'Fecha',
            'Rut',
            'Conductor',
            'Movil',
            'Patente',
            'Jornada',
            'Turno',
            'Servicio',
            'Inicio',
            'Termino',
            'Desde',
            'Hasta',
            'Solicitante',
            'Pasajeros',
            'KM 1',
            'KM 2',
            'Observaciones'
    ],'allTransports') !!}
@endsection
