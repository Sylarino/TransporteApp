@extends('layouts.modal.layout')
@section('modal-icon','fa-bell')
@section('modal-title','Crear Notificación')
@section('modal-content')
	{!! printCss([
		'libs/select2/select2.css',
		'libs/bootstrap-material-datetimepicker/bootstrap-material-datetimepicker.css'
	]) !!}
	{!! printScript([
		'libs/select2/select2.js',
		'libs/moment/moment.js',
		'libs/bootstrap-material-datetimepicker/bootstrap-material-datetimepicker.js'
	]) !!}
	<form class="" role="form"  id="notification-form">
		@csrf
		<div class="form-group">
			<label class="form-label">Destinatarios</label>
			<select class="select2 form-control" name="users[]" id="users" multiple="multiple">
				@forelse($users as $user)
					<option value="{{ $user->id }}">{{ $user->first_name }} {{ $user->last_name }}</option>
				@empty
					<option value="">No hay más usuarios...</option>
				@endforelse
			</select>
		</div>
		<div class="form-group">
			<label class="form-label">Título</label>
			<input type="text" class="form-control" id="title" name="title">
		</div>
		<div class="form-group">
			<label class="form-label">Mensaje</label>
			<textarea name="message" class="form-control" rows="5"></textarea>
		</div>
		<div class="row">
			<div class="col-lg-12">
				<div class="form-group">
					<label class="form-label">Fecha de Notificación</label>
					<input type="text" class="form-control" id="notification_date" name="notification_date" value="{{ Carbon\Carbon::today()->toDateString() }}">
				</div>
			</div>

		</div>

	</form>
	<script>
		$(document).ready(function(){
            $('#notification_date').bootstrapMaterialDatePicker({
                weekStart: 0,
                time: false,
                clearButton: true
            });
            $(".select2").select2({ dropdownParent: $("#remoteModal")});
		});
	</script>
@endsection
@section('modal-validation')
	{!!  makeValidation('#notification-form','/notifications', "location.reload()") !!}
@endsection
@section('modal-width','50')
