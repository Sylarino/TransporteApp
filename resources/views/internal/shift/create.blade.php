@extends('layouts.modal.layout')
@section('modal-icon','fa-clock')
@section('modal-title','Crear Turno')
@section('modal-content')
    <form class="" role="form"  id="shift-form">
        @csrf
        <div class="row">
            <div class="col">
                <div class="form-group">
                    <label class="form-label">Hora Inicio</label>
                    <input type="text" class="form-control"  name="start_time">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="form-group">
                    <label class="form-label">Hora Termino</label>
                    <input type="text" class="form-control"  name="end_time">
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col">
                <div class="form-group">
                    <label class="form-label">Nombre</label>
                    <input type="text" class="form-control"  name="name">
                </div>
            </div>
        </div>

    </form>
@endsection
@section('modal-validation')
    {!!  makeValidation('#shift-form','/shifts', "tableReload(); closeModal();") !!}
@endsection
@section('modal-width','30')
