@extends('layouts.app')

@section('title', 'Inicio')
@section('header', 'Inicio')

@section('content')
<div class="page-container">
    <section class="welcome-section">
        <div>
            <span class="eyebrow">TU ESPACIO</span>
            <h1>Hola, {{ Auth::user()->name }}</h1>
            <p>Comparte algo que quieras dejar por escrito.</p>
        </div>
        <a href="{{ route('posts.create') }}" class="btn btn-primary">
            <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M12 5v14M5 12h14"/></svg>
            Crear publicación
        </a>
    </section>

    <section class="posts-section">
        <div class="section-heading">
            <div>
                <h2>Últimas publicaciones</h2>
                <p>Ideas compartidas por la comunidad.</p>
            </div>
        </div>

        <div class="posts-list">
            @forelse($posts as $post)
                <article class="post-card">
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
                        <h3 class="post-title">{{ $post->title }}</h3>
                    @endif

                    <p class="post-content">{{ $post->content }}</p>

                    <div class="post-footer">
                        <a href="{{ route('posts.show', $post) }}" class="text-link">Ver publicación</a>
                    </div>
                </article>
            @empty
                <div class="empty-state card card-padding">
                    <h3>Todavía no hay publicaciones</h3>
                    <p>Sé la primera persona en compartir algo con la comunidad.</p>
                    <a href="{{ route('posts.create') }}" class="btn btn-primary">Publicar ahora</a>
                </div>
            @endforelse
        </div>

        @if($posts->hasPages())
            <div class="pagination">{{ $posts->links() }}</div>
        @endif
    </section>
</div>
@endsection
