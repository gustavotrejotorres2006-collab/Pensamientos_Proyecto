@extends('layouts.app')

@section('title', 'Crear cuenta')

@section('content')
<div class="auth-container">
    <div class="auth-card auth-card-register">
        <section class="auth-header">
            <div class="brand-mark" aria-hidden="true">P</div>
            <span class="eyebrow">NUEVA CUENTA</span>
            <h1>Únete a Pensamientos</h1>
            <p>Crea tu perfil y empieza a compartir notas, ideas y pensamientos con la comunidad.</p>
        </section>

        <section class="auth-panel">
            <div class="auth-heading">
                <h2>Crear cuenta</h2>
                <p>Completa tus datos para comenzar.</p>
            </div>

            <form method="POST" action="{{ route('register.store') }}" class="auth-form">
                @csrf

                <div class="form-grid">
                    <div class="form-group form-grid-full">
                        <label for="name">Nombre</label>
                        <input type="text" id="name" name="name" value="{{ old('name') }}" maxlength="100" required autocomplete="name">
                    </div>

                    <div class="form-group">
                        <label for="username">Nombre de usuario</label>
                        <input type="text" id="username" name="username" value="{{ old('username') }}" maxlength="50" pattern="[A-Za-z0-9_-]+" placeholder="ejemplo" required autocomplete="username">
                        <small>Usa letras, números, guiones o guiones bajos.</small>
                    </div>

                    <div class="form-group">
                        <label for="email">Correo electrónico</label>
                        <input type="email" id="email" name="email" value="{{ old('email') }}" maxlength="150" required autocomplete="email">
                    </div>

                    <div class="form-group">
                        <label for="password">Contraseña</label>
                        <div class="password-field">
                            <input type="password" id="password" name="password" minlength="8" required autocomplete="new-password">
                            <button type="button" class="password-toggle" data-password-toggle="password" aria-label="Mostrar contraseña">
                                <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M2.5 12s3.5-6 9.5-6 9.5 6 9.5 6-3.5 6-9.5 6-9.5-6-9.5-6Z"/><circle cx="12" cy="12" r="2.5"/></svg>
                            </button>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="password_confirmation">Confirmar contraseña</label>
                        <div class="password-field">
                            <input type="password" id="password_confirmation" name="password_confirmation" minlength="8" required autocomplete="new-password">
                            <button type="button" class="password-toggle" data-password-toggle="password_confirmation" aria-label="Mostrar contraseña">
                                <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M2.5 12s3.5-6 9.5-6 9.5 6 9.5 6-3.5 6-9.5 6-9.5-6-9.5-6Z"/><circle cx="12" cy="12" r="2.5"/></svg>
                            </button>
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary btn-full">Crear cuenta</button>
            </form>

            <div class="auth-footer">
                <span>¿Ya tienes una cuenta?</span>
                <a href="{{ route('login') }}">Iniciar sesión</a>
            </div>
        </section>
    </div>
</div>
@endsection
