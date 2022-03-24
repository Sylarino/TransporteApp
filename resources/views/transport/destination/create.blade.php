@extends('layouts.modal.layout')
@section('modal-icon','fa-map-marker-alt')
@section('modal-title','Crear Destino')
@section('modal-content')
    <form class="" role="form"  id="destination-form">
        @csrf
        <div class="row">
            <div class="col">
                <div class="form-group">
                    <label class="form-label">Lugar de trabajo</label>
                    <select name="workplace_id"  class="form-control">
                        <option value="" disabled >Seleccione...</option>
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
                    <label class="form-label">Nombre del destino</label>
                    <input type="text" class="form-control"  name="destination">
                </div>
            </div>
        </div>
    </form>
@endsection
@section('modal-validation')
    {!!  makeValidation('#destination-form','/destinations', "tableReload(); closeModal();") !!}
@endsection
@section('modal-width','30')
