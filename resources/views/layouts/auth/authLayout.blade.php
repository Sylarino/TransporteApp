<!DOCTYPE html>

<html lang="en" class="default-style">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="IE=edge,chrome=1">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0">

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name') }} -  @yield('page-title')</title>

    @include('layouts.libs.mainCss')

    {!! printCss([
        "css/pages/authentication.css"
    ]) !!}

    @include('layouts.libs.mainScripts')

    {!! printScript([
        "libs/popper/popper.js"
    ]) !!}

</head>

<body>
<div class="page-loader">
    <div class="bg-primary"></div>
</div>

<!-- Content -->

<div class="authentication-wrapper authentication-3">
    <div class="authentication-inner">

        <!-- Side container -->
        <!-- Do not display the container on extra small, small and medium screens -->
        <div class="d-none d-lg-flex col-lg-8 align-items-center ui-bg-cover ui-bg-overlay-container p-5" style="background-image: url('{{ asset('img/21.jpg') }}');">
            <div class="ui-bg-overlay bg-dark opacity-50"></div>

            <!-- Text -->
            <div class="w-100 text-white px-5">
                <h1 class="display-2 font-weight-bolder mb-4">{{ config('app.name') }}</h1>
                <div class="text-large font-weight-light">
                    Sistema de control de Transportes
                </div>
            </div>
            <!-- /.Text -->
        </div>
        <!-- / Side container -->

        <!-- Form container -->
        <div class="d-flex col-lg-4 align-items-center bg-white p-5">
            <!-- Inner container -->
            <!-- Have to add `.d-flex` to control width via `.col-*` classes -->
            <div class="d-flex col-sm-7 col-md-5 col-lg-12 px-0 px-xl-4 mx-auto">
                <div class="w-100">

                    <!-- Logo -->
                    <div class="d-flex justify-content-center align-items-center">
                       <h1 style="text-align:center; font-weight: bold; font-size: 4em">{{ config('app.name') }}</h1>
                    </div>
                    <!-- / Logo -->

                    @yield('content')

                </div>
            </div>
        </div>
        <!-- / Form container -->

    </div>
</div>
@yield('validation')
</body>

</html>
