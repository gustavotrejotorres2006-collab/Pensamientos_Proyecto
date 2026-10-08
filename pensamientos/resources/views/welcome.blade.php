@extends('layouts.app')

@section('title', 'Pensamientos')
@section('content')
<div class="auth-container">
    <div class="card card-padding welcome-card">
        <div class="brand-mark welcome-brand">P</div>
        <span class="eyebrow">PENSAMIENTOS</span>
        <h1>Un espacio para compartir ideas</h1>
        <p>Escribe, descubre y encuentra nuevas perspectivas.</p>
        <div class="welcome-actions">
            <a href="{{ route('login') }}" class="btn btn-primary">Iniciar sesión</a>
            <a href="{{ route('register') }}" class="btn btn-secondary">Crear cuenta</a>
        </div>
    </div>
</div>
@endsection
