@extends('layouts.modal.layout')
@section('modal-icon','fa-user')
@section('modal-title','Crear Usuario')
@section('modal-content')
    <form class="" role="form"  id="user-form">
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
    {!!  makeValidation('#user-form','/users', "tableReload(); closeModal();") !!}
@endsection
@section('modal-width','30')
