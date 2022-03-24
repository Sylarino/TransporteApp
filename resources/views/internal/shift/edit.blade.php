@extends('layouts.modal.layout')
@section('modal-icon','fa-clock')
@section('modal-title','Modificar Turno')
@section('modal-content')
    <form class="" role="form"  id="shift-form">
        @csrf
        @method('put')
        <div class="row">
            <div class="col">
                <div class="form-group">
                    <label class="form-label">Hora Inicio</label>
                    <input type="text" class="form-control"  name="start_time" value="{{ $shift->start_time }}">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="form-group">
                    <label class="form-label">Hora Termino</label>
                    <input type="text" class="form-control"  name="end_time" value="{{ $shift->end_time }}">
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col">
                <div class="form-group">
                    <label class="form-label">Nombre</label>
                    <input type="text" class="form-control"  name="name" value="{{ $shift->name }}">
                </div>
            </div>
        </div>

    </form>
@endsection
@section('modal-validation')
    {!!  makeValidation('#shift-form','/shifts/'.$shift->id, "tableReload(); closeModal();") !!}
@endsection
@section('modal-width','30')
