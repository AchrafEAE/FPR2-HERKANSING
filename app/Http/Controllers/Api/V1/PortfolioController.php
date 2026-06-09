<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Bio;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\JsonResponse;

class PortfolioController extends Controller
{
    public function show(): JsonResponse
    {
        /** @var Bio|null $bio */
        $bio = Bio::query()->with('user')->latest('updated_at')->first();

        if ($bio === null) {
            return response()->json([
                'data' => [
                    'headline' => 'Portfolio leeg',
                    'summary' => 'De bio wordt binnenkort toegevoegd.',
                    'owner' => null,
                ],
            ]);
        }

        return response()->json([
            'data' => [
                'owner' => $bio->user?->name,
                'headline' => $bio->headline,
                'summary' => $bio->summary,
                'location' => $bio->location,
                'availability' => $bio->availability,
                'website_url' => $bio->website_url,
                'linkedin_url' => $bio->linkedin_url,
                'github_url' => $bio->github_url,
                'years_experience' => $bio->years_experience,
                'updated_at' => $bio->updated_at,
            ],
        ]);
    }

    public function stats(): JsonResponse
    {
        return response()->json([
            'data' => [
                'total_users' => User::query()->count(),
                'total_posts' => Post::query()->whereNotNull('published_at')->count(),
                'server_time' => now()->toDateTimeString(),
                'status' => 'operational',
            ],
        ]);
    }
}
