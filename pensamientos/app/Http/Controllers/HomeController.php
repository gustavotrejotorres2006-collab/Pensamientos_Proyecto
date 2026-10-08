<?php

namespace App\Http\Controllers;

use App\Models\Post;

class HomeController extends Controller
{
    public function index()
    {
        $posts = Post::with('user')
            ->whereHas('user', fn ($query) => $query->where('is_active', true))
            ->latest()
            ->paginate(10);

        return view('home.index', compact('posts'));
    }
}
