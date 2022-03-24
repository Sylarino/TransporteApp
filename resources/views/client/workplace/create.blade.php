@extends('layouts.modal.layout')
@section('modal-icon','fa-map-marker')
@section('modal-title','Crear Servicio')
@section('modal-content')
    <form class="" role="form"  id="workplace-form">
        @csrf
        <div class="row">
            <div class="col">
                <div class="form-group">
                    <label class="form-label">Empresa</label>
                    <input type="text" class="form-control"  name="enterprise">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="form-group">
                    <label class="form-label">Servicio</label>
                    <input type="text" class="form-control"  name="service">
                </div>
            </div>
        </div>

    </form>
@endsection
@section('modal-validation')
    {!!  makeValidation('#workplace-form','/workplaces', "tableReload(); closeModal();") !!}
@endsection
@section('modal-width','30')
