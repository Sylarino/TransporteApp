@extends('layouts.modal.layout')
@section('modal-icon','fa-user')
@section('modal-title','Crear Conductor')
@section('modal-content')
    <form class="" role="form"  id="driver-form">
        @csrf
        <div class="row">
            <div class="col">
                <div class="form-group">
                    <label class="form-label">Rut</label>
                    <input type="text" class="form-control"  name="rut">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="form-group">
                    <label class="form-label">Nombre</label>
                    <input type="text" class="form-control"  name="first_name">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="form-group">
                    <label class="form-label">Apellido Paterno</label>
                    <input type="text" class="form-control"  name="last_name">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="form-group">
                    <label class="form-label">Email</label>
                    <input type="text" class="form-control" name="email">
                </div>
            </div>
        </div>
    </form>

@endsection
@section('modal-validation')
    {!!  makeValidation('#driver-form','/drivers', "tableReload(); closeModal();") !!}
@endsection
@section('modal-width','30')
