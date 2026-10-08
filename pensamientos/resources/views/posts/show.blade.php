@extends('layouts.app')

@section('title', $post->title ?: 'Publicación')
@section('header', 'Publicación')

@section('content')
<div class="page-container narrow-container">
    <article class="card post-detail">
        <div class="post-header">
            <a href="{{ route('profile.show', $post->user) }}" class="post-user">
                <span class="avatar">{{ strtoupper(substr($post->user->name, 0, 1)) }}</span>
                <span class="post-user-info">
                    <strong>{{ $post->user->name }}</strong>
                    <span>{{ '@' . $post->user->username }}</span>
                </span>
            </a>
            <time datetime="{{ $post->created_at->toIso8601String() }}">{{ $post->created_at->diffForHumans() }}</time>
        </div>

        @if($post->title)
            <h1 class="post-detail-title">{{ $post->title }}</h1>
        @endif

        <div class="post-detail-content">{{ $post->content }}</div>

        @if($post->user_id === Auth::id())
            <div class="form-actions post-detail-actions">
                <a href="{{ route('posts.edit', $post) }}" class="btn btn-secondary">Editar</a>
                <form method="POST" action="{{ route('posts.destroy', $post) }}" data-confirm-delete>
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Eliminar</button>
                </form>
            </div>
        @endif
    </article>
</div>
@endsection
