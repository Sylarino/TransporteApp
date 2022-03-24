@extends('layouts.auth.authLayout')
@section('page-title','Login')
@section('content')
    <h4 class="text-center text-lighter font-weight-normal mt-5 mb-0">Loguear a tu cuenta</h4>

    <!-- Form -->
    <form class="my-5" id="login-form">
        @csrf
        <div class="form-group">
            <label class="form-label">Correo electrónico</label>
            <input type="text" class="form-control" name="email" id="email">
        </div>
        <div class="form-group">
            <label class="form-label d-flex justify-content-between align-items-end">
                <div>Contraseña</div>
                <a href="{{ route('main.forgot-password') }}" class="d-block small">Olvidó su contraseña?</a>
            </label>
            <input type="password" class="form-control" name="password" id="password">
        </div>

        <div class="d-flex justify-content-between align-items-center m-0">
            <label class="custom-control custom-checkbox m-0">
                <input type="checkbox" class="custom-control-input" name="rememberMe" id="remember_me">
                <span class="custom-control-label">Recuérdame</span>
            </label>
            <button type="submit" class="btn btn-primary">Loguear</button>
        </div>
    </form>
    <!-- / Form -->

    <div class="text-center text-muted">
        No tienes una cuenta?,
        <a href="{{ route('main.register') }}"> Registrate</a>
    </div>
@endsection
@section('validation')
    {!! makeValidation('#login-form','/login', "location.href = '/';") !!}
@endsection
