@extends('layouts.app')

@section('title', 'Perfil de @'.$user->username)
@section('header', 'Perfil')

@section('content')
<div class="page-container">
    <section class="profile-header">
        <div class="profile-info">
            <div class="profile-avatar">{{ strtoupper(substr($user->name, 0, 1)) }}</div>
            <div>
                <h1 class="profile-name">{{ $user->name }}</h1>
                <p class="profile-username">{{ '@' . $user->username }}</p>
            </div>
        </div>
        @if($user->bio)
            <p class="profile-bio">{{ $user->bio }}</p>
        @endif
    </section>

    <section class="posts-section">
        <div class="section-heading">
            <div>
                <h2>Publicaciones</h2>
                <p>Lo que {{ $user->name }} ha compartido.</p>
            </div>
        </div>

        <div class="posts-list">
            @forelse($posts as $post)
                <article class="post-card">
                    <div class="post-header">
                        <span class="post-user">
                            <span class="avatar">{{ strtoupper(substr($user->name, 0, 1)) }}</span>
                            <span class="post-user-info">
                                <strong>{{ $user->name }}</strong>
                                <span>{{ '@' . $user->username }}</span>
                            </span>
                        </span>
                        <time datetime="{{ $post->created_at->toIso8601String() }}">{{ $post->created_at->diffForHumans() }}</time>
                    </div>
                    @if($post->title)<h3 class="post-title">{{ $post->title }}</h3>@endif
                    <p class="post-content">{{ $post->content }}</p>
                    <div class="post-footer"><a href="{{ route('posts.show', $post) }}" class="text-link">Ver publicación</a></div>
                </article>
            @empty
                <div class="empty-state card card-padding">
                    <h3>Aún no hay publicaciones</h3>
                    <p>Este perfil todavía no ha compartido pensamientos.</p>
                </div>
            @endforelse
        </div>

        @if($posts->hasPages())
            <div class="pagination">{{ $posts->links() }}</div>
        @endif
    </section>
</div>
@endsection
