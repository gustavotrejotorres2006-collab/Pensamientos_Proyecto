@extends('layouts.app')

@section('title', 'Buscar')
@section('header', 'Buscar')

@section('content')
<div class="page-container">
    <div class="page-heading">
        <span class="eyebrow">EXPLORAR</span>
        <h1>Encuentra personas e ideas</h1>
        <p>Busca por nombre de usuario, nombre, título o contenido.</p>
    </div>

    <form method="GET" action="{{ route('search') }}" class="search-form">
        <label class="sr-only" for="q">Buscar</label>
        <div class="search-input-wrap">
            <svg viewBox="0 0 24 24" aria-hidden="true"><circle cx="11" cy="11" r="7"/><path d="m20 20-4-4"/></svg>
            <input type="search" id="q" name="q" value="{{ $query }}" placeholder="Busca personas o publicaciones..." autofocus>
        </div>
        <button type="submit" class="btn btn-primary">Buscar</button>
    </form>

    @if($query !== '')
        <section class="search-results">
            <div class="section-heading"><div><h2>Personas</h2><p>Coincidencias para “{{ $query }}”.</p></div></div>
            <div class="user-results">
                @forelse($users as $user)
                    <a href="{{ route('profile.show', $user) }}" class="user-result card">
                        <span class="avatar">{{ strtoupper(substr($user->name, 0, 1)) }}</span>
                        <span><strong>{{ $user->name }}</strong><small>{{ '@' . $user->username }}</small></span>
                    </a>
                @empty
                    <div class="empty-state card card-padding"><p>No encontramos personas con ese término.</p></div>
                @endforelse
            </div>
        </section>

        <section class="search-results">
            <div class="section-heading"><div><h2>Publicaciones</h2><p>Resultados relacionados con tu búsqueda.</p></div></div>
            <div class="posts-list">
                @forelse($posts as $post)
                    <article class="post-card">
                        <div class="post-header">
                            <a href="{{ route('profile.show', $post->user) }}" class="post-user">
                                <span class="avatar">{{ strtoupper(substr($post->user->name, 0, 1)) }}</span>
                                <span class="post-user-info"><strong>{{ $post->user->name }}</strong><span>{{ '@' . $post->user->username }}</span></span>
                            </a>
                            <time>{{ $post->created_at->diffForHumans() }}</time>
                        </div>
                        @if($post->title)<h3 class="post-title">{{ $post->title }}</h3>@endif
                        <p class="post-content">{{ $post->content }}</p>
                        <div class="post-footer"><a href="{{ route('posts.show', $post) }}" class="text-link">Ver publicación</a></div>
                    </article>
                @empty
                    <div class="empty-state card card-padding"><p>No encontramos publicaciones con ese término.</p></div>
                @endforelse
            </div>
            @if($posts->hasPages())<div class="pagination">{{ $posts->links() }}</div>@endif
        </section>
    @else
        <div class="empty-state card card-padding search-empty">
            <svg viewBox="0 0 24 24" aria-hidden="true"><circle cx="11" cy="11" r="7"/><path d="m20 20-4-4"/></svg>
            <h2>Comienza una búsqueda</h2>
            <p>Escribe algo en el buscador para encontrar contenido de la comunidad.</p>
        </div>
    @endif
</div>
@endsection
