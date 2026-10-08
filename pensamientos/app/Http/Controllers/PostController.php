<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function create()
    {
        return view('posts.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => ['nullable', 'string', 'max:150'],
            'content' => ['required', 'string', 'max:5000'],
        ], [
            'content.required' => 'Escribe algo antes de publicar.',
            'content.max' => 'La publicación no puede superar los 5000 caracteres.',
        ]);

        Post::create([
            'user_id' => Auth::id(),
            'title' => $data['title'] ?? null,
            'content' => trim($data['content']),
        ]);

        return redirect()->route('home')->with('success', 'Publicación creada correctamente.');
    }

    public function show(Post $post)
    {
        abort_unless($post->user?->is_active, 404);
        $post->load('user');

        return view('posts.show', compact('post'));
    }

    public function edit(Post $post)
    {
        $this->authorizePost($post);
        return view('posts.edit', compact('post'));
    }

    public function update(Request $request, Post $post)
    {
        $this->authorizePost($post);

        $data = $request->validate([
            'title' => ['nullable', 'string', 'max:150'],
            'content' => ['required', 'string', 'max:5000'],
        ], [
            'content.required' => 'Escribe algo antes de guardar.',
            'content.max' => 'La publicación no puede superar los 5000 caracteres.',
        ]);

        $post->update([
            'title' => $data['title'] ?? null,
            'content' => trim($data['content']),
        ]);

        return redirect()->route('posts.show', $post)->with('success', 'Publicación actualizada correctamente.');
    }

    public function destroy(Post $post)
    {
        $this->authorizePost($post);
        $post->delete();

        return redirect()->route('home')->with('success', 'Publicación eliminada correctamente.');
    }

    private function authorizePost(Post $post): void
    {
        abort_unless($post->user_id === Auth::id(), 403);
    }
}
