@extends('layouts.auth.authLayout')
@section('page-title','Register')
@section('content')
    <h4 class="text-center text-lighter font-weight-normal mt-5 mb-0">Crear una cuenta</h4>

    <!-- Form -->
    <form class="my-5" id="register-form">
        @csrf
        <div class="form-group">
            <label class="form-label">Nombre</label>
            <input type="text" class="form-control" name="first_name">
        </div>
        <div class="form-group">
            <label class="form-label">Apellido</label>
            <input type="text" class="form-control" name="last_name">
        </div>
        <div class="form-group">
            <label class="form-label">Correo electrónico</label>
            <input type="text" class="form-control" name="email">
        </div>
        <div class="form-group">
            <label class="form-label">Contraseña</label>
            <input type="password" class="form-control" name="password">
        </div>
        <div class="form-group">
            <label class="form-label">Reingrese Contraseña</label>
            <input type="password" class="form-control" name="password_confirmation">
        </div>
        <button type="submit" class="btn btn-primary btn-block mt-4">Registrarse</button>
    </form>
    <!-- / Form -->

    <div class="text-center text-muted">
        Ya tienes una cuenta?,
        <a href="{{ route('main.login') }}"> Loguea</a>
    </div>
@endsection
@section('validation')
    {!! makeValidation('#register-form','/register', "location.href = '/login';") !!}
@endsection
