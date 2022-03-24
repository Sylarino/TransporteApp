@extends('layouts.modal.layout')
@section('modal-icon','fa-bell')
@section('modal-title')
	{{ $notification->title }}
@endsection
@section('modal-content')
	<h5>Mensaje:</h5>
	<p>{{ $notification->message }}</p>
	<hr>
	<p class="text-muted">Fecha de Notificación: {{ $notification->notification_date }}</p>
	<hr>
	<p>
		<small>
			Destinatarios: <br>
			@foreach($notification->receivers as $user)
				@if($notification->user_id == Sentinel::getUser()->id)
					<span class="@if($user->pivot->readed_at != null) badge badge-success @endif">yo</span>,
				@else
					<span class="@if($user->pivot->readed_at != null) badge badge-info @else badge badge-default @endif">{{ $user->getFullName() }}</span>,
				@endif
			@endforeach
		</small>
	</p>
@endsection
@section('no-submit')
	@if($notification->url != null)
		<a href="{{ $notification->url }}" class="btn btn-info">Ir</a>
		@if(Sentinel::getUser()->id == $notification->user_id)
			{!! makeDeleteButton('Realmente desesa Eliminar la notificación?',$notification->id,'') !!}
		@endif
	@else
		@if(Sentinel::getUser()->id == $notification->user_id)
			{!! makeDeleteButton('Realmente desesa Eliminar la notificación?',$notification->id,'') !!}
		@else
			<p class="text-muted"><small>Esta notificiación no posee links</small></p>
		@endif
	@endif


@endsection
@section('modal-width','50')
