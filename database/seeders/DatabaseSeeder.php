<?php

namespace Database\Seeders;

use App\Enums\PostStatus;
use App\Models\Bio;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'password',
        ]);

        $user = User::query()->first();

        if ($user !== null) {
            Bio::factory()->for($user)->create([
                'headline' => 'Full-stack developer in opleiding',
                'summary' => 'Gebruikt deze demo om bio content en workflowbeheer te testen.',
                'availability' => 'Beschikbaar voor projecten',
            ]);

            Post::factory()->count(3)->for($user)->create([
                'status' => PostStatus::Draft,
            ]);
        }
    }
}
