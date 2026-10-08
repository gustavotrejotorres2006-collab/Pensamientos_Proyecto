@extends('layouts.app')

@section('title', 'Editar publicación')
@section('header', 'Editar publicación')

@section('content')
<div class="page-container narrow-container">
    <div class="page-heading">
        <span class="eyebrow">EDITAR</span>
        <h1>Actualiza tu publicación</h1>
        <p>Realiza los cambios que necesites y guarda la versión actualizada.</p>
    </div>

    <form method="POST" action="{{ route('posts.update', $post) }}" class="card form-card">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="title">Título <span class="optional">Opcional</span></label>
            <input type="text" id="title" name="title" value="{{ old('title', $post->title) }}" maxlength="150">
        </div>

        <div class="form-group">
            <label for="content">Contenido</label>
            <textarea id="content" name="content" maxlength="5000" required>{{ old('content', $post->content) }}</textarea>
            <div class="field-hint"><span>Máximo 5000 caracteres.</span><span data-character-count>0 / 5000</span></div>
        </div>

        <div class="form-actions">
            <a href="{{ route('posts.show', $post) }}" class="btn btn-secondary">Cancelar</a>
            <button type="submit" class="btn btn-primary">Guardar cambios</button>
        </div>
    </form>
</div>
@endsection
