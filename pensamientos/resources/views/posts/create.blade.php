@extends('layouts.app')

@section('title', 'Publicar')
@section('header', 'Nueva publicación')

@section('content')
<div class="page-container narrow-container">
    <div class="page-heading">
        <span class="eyebrow">PUBLICAR</span>
        <h1>Comparte un pensamiento</h1>
        <p>Escribe una nota, una reflexión o cualquier idea que quieras compartir.</p>
    </div>

    <form method="POST" action="{{ route('posts.store') }}" class="card form-card">
        @csrf
        <div class="form-group">
            <label for="title">Título <span class="optional">Opcional</span></label>
            <input type="text" id="title" name="title" value="{{ old('title') }}" maxlength="150" placeholder="Dale un título a tu publicación">
        </div>

        <div class="form-group">
            <label for="content">Contenido</label>
            <textarea id="content" name="content" maxlength="5000" required placeholder="¿Qué estás pensando?">{{ old('content') }}</textarea>
            <div class="field-hint"><span>Máximo 5000 caracteres.</span><span data-character-count>0 / 5000</span></div>
        </div>

        <div class="form-actions">
            <a href="{{ route('home') }}" class="btn btn-secondary">Cancelar</a>
            <button type="submit" class="btn btn-primary">Publicar</button>
        </div>
    </form>
</div>
@endsection
