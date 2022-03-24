@extends('layouts.modal.layout')
@section('modal-icon','fa-car')
@section('modal-title','Crear Movil')
@section('modal-content')
    <form class="" role="form"  id="mobile-form">
        @csrf
        <div class="row">
            <div class="col">
                <div class="form-group">
                    <label class="form-label">Servicio</label>
                    <select name="service_id" class="form-control">
                        <option value="" disabled="" selected="">Seleccione...</option>
                        @foreach($workplaces as $workplace)
                            <option value="{{ $workplace->id }}">{{ $workplace->service }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="form-group">
                    <label class="form-label">Movil</label>
                    <input type="text" class="form-control"  name="mobile">
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col">
                <div class="form-group">
                    <label class="form-label">Patente</label>
                    <input type="text" class="form-control"  name="patent">
                </div>
            </div>
        </div>

    </form>
@endsection
@section('modal-validation')
    {!!  makeValidation('#mobile-form','/mobiles', "tableReload(); closeModal();") !!}
@endsection
@section('modal-width','30')
