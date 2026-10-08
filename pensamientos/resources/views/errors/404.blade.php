@extends('layouts.app')
@section('title', 'Página no encontrada')
@section('content')
<div class="auth-container"><div class="card card-padding error-page"><span class="eyebrow">ERROR 404</span><h1>Página no encontrada</h1><p>El recurso que buscas no existe o ya no está disponible.</p><a href="{{ auth()->check() ? route('home') : route('login') }}" class="btn btn-primary">Volver</a></div></div>
@endsection
