<?php

namespace App\Http\Controllers;

use App\Models\User;

class ProfileController extends Controller
{
    public function show(User $user)
    {
        abort_unless($user->is_active, 404);

        $posts = $user->posts()
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('profile.show', compact('user', 'posts'));
    }
}
