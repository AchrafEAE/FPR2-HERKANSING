<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Bio;
use App\Models\Post;
use App\Models\StudyResult;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

final class DashboardController
{
    public function index(Request $request): View
    {
        /** @var \App\Models\User $user */
        $user = $request->user();

        $bio = Bio::query()->where('user_id', $user->id)->first();
        $postsQuery = Post::query()->where('user_id', $user->id);

        $studyResults = StudyResult::query()
            ->where('user_id', $user->id)
            ->pluck('earned_ec', 'course_code')
            ->toArray();

        return view('dashboard', [
            'bio' => $bio,
            'studyProgress' => config('portfolio.study_progress'),
            'studyResults' => $studyResults,
            'posts' => (clone $postsQuery)->latest()->limit(5)->get(),
            'draftCount' => (clone $postsQuery)->whereNull('published_at')->count(),
            'publishedCount' => (clone $postsQuery)->whereNotNull('published_at')->count(),
        ]);
    }
}
