<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Enums\PostStatus;
use App\Models\Bio;
use App\Models\Post;
use Illuminate\Http\Request;

final class DashboardController
{
    public function index(Request $request)
    {
        $user = $request->user();

        $bio = Bio::query()->where('user_id', $user->id)->first();
        $postsQuery = Post::query()->where('user_id', $user->id);

        return view('dashboard', [
            'bio' => $bio,
            'posts' => (clone $postsQuery)->latest()->limit(5)->get(),
            'draftCount' => (clone $postsQuery)->where('status', PostStatus::Draft->value)->count(),
            'publishedCount' => (clone $postsQuery)->where('status', PostStatus::Published->value)->count(),
        ]);
    }
}
