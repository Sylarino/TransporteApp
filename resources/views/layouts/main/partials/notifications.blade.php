<div class="bg-primary text-center text-white font-weight-bold p-3">
	@if($user)
		@if(count($user->unread_notifications) == 1)
			Tienes 1 Notificación.
		@else
			Tienes {{ count($user->unread_notifications)  }} Notificaciones.
		@endif
	@else
		No tienes Notificaciones esta semana.
	@endif
</div>
<div class="list-group list-group-flush" id="notifications-list-view" >
	@if($user)
		@foreach($user->unread_notifications as $notification)
			<a href="{{ route('notifications.show',['id' => $notification->id]) }}" {!! makeLinkRemote() !!} class="list-group-item list-group-item-action media d-flex notification-item align-items-center">
				<div class="ui-icon ui-icon-sm ion ion-md-mail bg-secondary border-0 text-white"></div>
				<div class="media-body line-height-condenced ml-3">
					<div class="text-dark">{{ $notification->title }}</div>
					<div class="text-light small mt-1">
						{{ substr($notification->message,0,50) }} ...
					</div>
					<div class="text-light small mt-1">{{ $notification->notification_date }}</div>
				</div>
			</a>
			@break($loop->iteration == 4)
		@endforeach
	@else
		<a href="javascript:void(0)" class="list-group-item list-group-item-action media d-flex align-items-center">
			No hay notificaciones
		</a>
	@endif
</div>
@if($export_reminders &&  count($export_reminders) > 0)
    <br>
<div class="list-group list-group-flush" id="export_reminders-list-view" >
    <h6>Archivos Exportados</h6>
    @foreach($export_reminders as $reminder)
        <a href="{{ route('exports.downloadQueued',['file_name' => $reminder->file]) }}" class="list-group-item notification-item export-reminder list-group-item-action media d-flex align-items-center exportable_reminder" id="exportable_reminder_{{ $reminder->id }}">
            <div class="ui-icon ui-icon-sm ion ion-md-document bg-secondary border-0 text-white"></div>
            <div class="media-body line-height-condenced ml-3">
                <div class="text-dark"><i class="fa fa-check-circle text-success"></i> Listo</div>
                <div class="text-light small mt-1">
                    {{ $reminder->file }}
                </div>
                <div class="text-light small mt-1">Click para descargar</div>
            </div>
        </a>
    @endforeach
</div>
    <script>
        $('.exportable_reminder').click(function(e){
            $(this).remove();
        });
    </script>
@endif
<a href="{{ route('notifications.index') }}" class="d-block text-center text-light small p-2 my-1">Ver Todas</a>
