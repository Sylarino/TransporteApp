@extends('layouts.main.app')
@section('page-title','Notificaciones')
@section('page-icon','bell')
@section('content')
	{!! printCss(['libs/fullcalendar/fullcalendar.css']) !!}
	{!! printScript(['libs/moment/moment.js','libs/fullcalendar/fullcalendar.js','libs/fullcalendar/locale-all.js']) !!}
	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header" >
					<div class="row">
						<div class="col-lg-7 col-md-7 col-sm-6">
							Notificaciones
						</div>
						<div class="col-lg-5 col-md-5 col-sm-6">
							<div class="float-right">
								{!! makeAddLink() !!}
							</div>
						</div>
					</div>

				</div>
				<div class="card-body">
					<div id="calendar"></div>
				</div>
			</div>
		</div>
	</div>
	<script>
        $(document).ready(function() {
            $.ajax({
                url: '/calendar/getUserNotifications',
                type: 'GET',
                data: 'type=fetch',
                async: false,
                success: function(response){
                    json_events = response;
                }
            });
            var today = new Date();
            var y = today.getFullYear();
            var m = today.getMonth();
            var d = today.getDate();
            $('#calendar').fullCalendar({
                locale : 'es',
                eventRender: function(eventObj, $el) {
                    $el.popover({
                        title: eventObj.title,
                        content: eventObj.description,
                        trigger: 'hover',
                        placement: 'top',
                        container: 'body'
                    });
                },
                themeSystem: 'bootstrap4',
                bootstrapFontAwesome: {
                    close: ' ion ion-md-close',
                    prev: ' ion ion-ios-arrow-back scaleX--1-rtl',
                    next: ' ion ion-ios-arrow-forward scaleX--1-rtl',
                    prevYear: ' ion ion-ios-arrow-dropleft-circle scaleX--1-rtl',
                    nextYear: ' ion ion-ios-arrow-dropright-circle scaleX--1-rtl'
                },
                header: {
                    center: 'listDay,listWeek,month',
                    right: 'prev,next today'
                },

                // customize the button names,
                views: {
                    listDay: {
                        buttonText: 'Día'
                    },
                    listWeek: {
                        buttonText: 'Semana'
                    }
                },
                navLinks: true, // can click day/week names to navigate views
                editable: false,
                defaultView: 'listWeek',
                events: JSON.parse(json_events),
                eventClick: function(event, jsEvent, view) {
                    loadModal('/notifications/'+event.id);
                    $('#remoteModal').modal('toggle');
                }
            });
        });
	</script>
@endsection

