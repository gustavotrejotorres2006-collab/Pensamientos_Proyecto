<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $query = trim($request->string('q')->toString());

        $users = collect();
        $posts = Post::query()->whereKey(0)->paginate(10)->withQueryString();

        if ($query !== '') {
            $users = User::query()
                ->where('is_active', true)
                ->where(function ($builder) use ($query) {
                    $builder
                        ->where('name', 'like', "%{$query}%")
                        ->orWhere('username', 'like', "%{$query}%");
                })
                ->orderBy('name')
                ->limit(10)
                ->get();

            $posts = Post::with('user')
                ->whereHas('user', fn ($builder) => $builder->where('is_active', true))
                ->where(function ($builder) use ($query) {
                    $builder
                        ->where('title', 'like', "%{$query}%")
                        ->orWhere('content', 'like', "%{$query}%");
                })
                ->latest()
                ->paginate(10)
                ->withQueryString();
        }

        return view('search.index', compact('query', 'users', 'posts'));
    }
}
