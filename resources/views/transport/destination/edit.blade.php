@extends('layouts.modal.layout')
@section('modal-icon','fa-map-marker-alt')
@section('modal-title','Modificar Destino')
@section('modal-content')
    <form class="" role="form"  id="destination-form">
        @csrf
        @method('put')
        <div class="row">
            <div class="col">
                <div class="form-group">
                    <label class="form-label">Lugar de trabajo</label>
                    <select name="workplace_id"  class="form-control">
                        <option value="" disabled >Seleccione...</option>
                        @foreach($workplaces as $workplace)
                            @if($workplace->id == $destination->workplace_id)
                                <option value="{{ $workplace->id }}" selected>{{ $workplace->service }}</option>
                            @else
                                <option value="{{ $workplace->id }}">{{ $workplace->service }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="form-group">
                    <label class="form-label">Nombre del destino</label>
                    <input type="text" class="form-control"  name="destination" value="{{ $destination->destination  }}">
                </div>
            </div>
        </div>
    </form>
@endsection
@section('modal-validation')
    {!!  makeValidation('#destination-form','/destinations/'.$destination->id, "tableReload(); closeModal();") !!}
@endsection
@section('modal-width','30')
