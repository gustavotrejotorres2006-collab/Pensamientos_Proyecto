@extends('layouts.app')

@section('title', 'Iniciar sesión')

@section('content')
<div class="auth-container">
    <div class="auth-card">
        <section class="auth-header">
            <div class="brand-mark" aria-hidden="true">P</div>
            <span class="eyebrow">PENSAMIENTOS</span>
            <h1>Bienvenido</h1>
            <p>Comparte tus ideas y descubre nuevas perspectivas en un espacio hecho para expresarte.</p>
        </section>

        <section class="auth-panel">
            <div class="auth-heading">
                <h2>Iniciar sesión</h2>
                <p>Accede a tu cuenta para continuar.</p>
            </div>

            <form method="POST" action="{{ route('login.store') }}" class="auth-form">
                @csrf

                <div class="form-group">
                    <label for="login">Usuario o correo</label>
                    <input type="text" id="login" name="login" value="{{ old('login') }}" required autofocus autocomplete="username">
                </div>

                <div class="form-group">
                    <div class="label-row">
                        <label for="password">Contraseña</label>
                    </div>
                    <div class="password-field">
                        <input type="password" id="password" name="password" required autocomplete="current-password">
                        <button type="button" class="password-toggle" data-password-toggle="password" aria-label="Mostrar contraseña">
                            <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M2.5 12s3.5-6 9.5-6 9.5 6 9.5 6-3.5 6-9.5 6-9.5-6-9.5-6Z"/><circle cx="12" cy="12" r="2.5"/></svg>
                        </button>
                    </div>
                </div>

                <label class="checkbox-field">
                    <input type="checkbox" name="remember" value="1" @checked(old('remember'))>
                    <span>Recordarme</span>
                </label>

                <button type="submit" class="btn btn-primary btn-full">Iniciar sesión</button>
            </form>

            <div class="auth-footer">
                <span>¿No tienes una cuenta?</span>
                <a href="{{ route('register') }}">Crear cuenta</a>
            </div>
        </section>
    </div>
</div>
@endsection
