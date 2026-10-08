@extends('layouts.app')
@section('title', 'Acceso denegado')
@section('content')
<div class="auth-container"><div class="card card-padding error-page"><span class="eyebrow">ERROR 403</span><h1>No tienes permiso</h1><p>No puedes realizar esta acción sobre este contenido.</p><a href="{{ auth()->check() ? route('home') : route('login') }}" class="btn btn-primary">Volver</a></div></div>
@endsection
