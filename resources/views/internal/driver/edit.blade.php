@extends('layouts.modal.layout')
@section('modal-icon','fa-user')
@section('modal-title','Modificar Conductor')
@section('modal-content')
    <form class="" role="form"  id="driver-form">
        @csrf
        @method('put')
        <div class="row">
            <div class="col">
                <div class="form-group">
                    <label class="form-label">Rut</label>
                    <input type="text" class="form-control"  name="rut" value="{{ $driver->first_name }}">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="form-group">
                    <label class="form-label">Nombre</label>
                    <input type="text" class="form-control"  name="first_name" value="{{ $user->first_name }}">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="form-group">
                    <label class="form-label">Apellido Paterno</label>
                    <input type="text" class="form-control"  name="last_name" value="{{ $user->last_name }}">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="form-group">
                    <label class="form-label">Email</label>
                    <input type="text" class="form-control" name="email" value="{{ $user->email }}">
                </div>
            </div>
        </div>
    </form>
@endsection
@section('modal-validation')
    {!!  makeValidation('#driver-form','/drivers/'.$driver->id, "tableReload(); closeModal();") !!}
@endsection
@section('modal-width','30')
