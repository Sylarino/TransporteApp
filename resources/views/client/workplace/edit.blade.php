@extends('layouts.modal.layout')
@section('modal-icon','fa-map-marker')
@section('modal-title','Modificar Servicio')
@section('modal-content')
    <form class="" role="form"  id="workplace-form">
        @csrf
        @method('put')
        <div class="row">
            <div class="col">
                <div class="form-group">
                    <label class="form-label">Empresa</label>
                    <input type="text" class="form-control"  name="enterprise" value="{{ $workplace->enterprise }}">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="form-group">
                    <label class="form-label">Servicio</label>
                    <input type="text" class="form-control"  name="service" value="{{ $workplace->service }}">
                </div>
            </div>
        </div>

    </form>
@endsection
@section('modal-validation')
    {!!  makeValidation('#workplace-form','/workplaces/'.$workplace->id, "tableReload(); closeModal();") !!}
@endsection
@section('modal-width','30')
