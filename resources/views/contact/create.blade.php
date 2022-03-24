@extends('layouts.modal.layout')
@section('modal-icon','fa-address-book')
@section('modal-title','Crear Contacto')
@section('modal-content')
    <form class="" role="form"  id="contact-form">
        @csrf
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
                    <label class="form-label">Apellido</label>
                    <input type="text" class="form-control"  name="last_name">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="form-group">
                    <label class="form-label">Telefonos</label>
                    <input type="text" class="form-control" name="phones">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="form-group">
                    <label class="form-label">Correo Electronico</label>
                    <input type="text" class="form-control" name="email">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="form-group">
                    <label class="form-label">Direccion</label>
                    <input type="text" class="form-control" name="address">
                </div>
            </div>
        </div>
    </form>
@endsection
@section('modal-validation')
    {!!  makeValidation('#contact-form','/contacts', "tableReload(); closeModal();") !!}
@endsection
@section('modal-width','30')
