<!DOCTYPE html>

<html lang="{{ config('app.lang') }}" class="default-style">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="IE=edge,chrome=1">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0">

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name') }}</title>

    @include('layouts.libs.mainCss')
    @include('layouts.libs.mainScripts')
    {!! printScript([
        "js/layout-helpers.js","js/plugins/demo.js"]) !!}



    {!! printCss(["libs/perfect-scrollbar/perfect-scrollbar.css"]) !!}
    {!! includeDT() !!}
</head>

<body class="">
<div class="page-loader">
    <div class="bg-primary"></div>
</div>

<!-- Layout wrapper -->
<div class="layout-wrapper layout-2">
    <div class="layout-inner">

        <!-- Layout sidenav -->
        @include("layouts.main.partials.sideMenu")
        <!-- / Layout sidenav -->

        <!-- Layout container -->
        <div class="layout-container">
            <!-- Layout navbar -->
            @include("layouts.main.partials.navBar")
            <!-- / Layout navbar -->

            <!-- Layout content -->
            <div class="layout-content bg-lightest">

                <!-- Content -->
                <div class="container-fluid flex-grow-1 container-p-y">
                    <h4 class="font-weight-bold mb-4">
                        <i class="fas fa-@yield('page-icon')"></i> @yield('page-title')
                    </h4>
                    <hr class="border-light container-m--x mt-0 mb-4">
                    @if(session()->has('message'))
                        <div class="alert alert-info alert-dismissible fade show">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                            <i class="fas fa-info-circle"></i> {{ session()->get('message') }}
                        </div>
                    @endif
                    @yield('content')
                </div>
                <!-- / Content -->
            </div>
            <!-- Layout content -->

        </div>
        <!-- / Layout container -->

    </div>

    <!-- Overlay -->
    <div class="layout-overlay layout-sidenav-toggle"></div>
</div>
<!-- / Layout wrapper -->

<!-- Core scripts -->
    <div class="modal fade bs-example-modal-lg"  id="remoteModal" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">

            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
<script>
    $(document).ready(function(){
        getNotificationsForMainPage();
        setInterval('getNotificationsForMainPage()',600000);

    });



    function getNotificationsForMainPage()
    {
        let notifications_view  = $('#notifications-view');
        let notification_badge = $('#notifications-badge');
        $.get('/getUserNotificationsList',function(html){
            notifications_view.html(html);
            let not_count = $(".notification-item").length;
            let export_reminders = $(".export-reminder").length;
            if( not_count > 0) {
                notification_badge.removeClass('badge-primary');
                notification_badge.addClass('badge-danger');
            } else {
                notification_badge.removeClass('badge-danger');
                notification_badge.removeClass('badge-primary');
                notification_badge.addClass('badge-primary');
            }

            if(export_reminders > 0 ){
                toastr.info("Tienes "+ export_reminders + "archivo (s) listo para descargar.","Creacion Completada!",{
                    positionClass: 'toast-bottom-right',
                    closeButton: true
                });
            }

        });
    }
    let remoteModal = $('#remoteModal');
    remoteModal.on('show.bs.modal', function (e) {
        $(this).find('.modal-content').load(e.relatedTarget.href);
    });
    remoteModal.on('hidden.bs.modal', function (e) {
        $('#remoteModal .modal-content').html('');
        $('.dtp').remove();
    });

</script>
</body>

</html>
