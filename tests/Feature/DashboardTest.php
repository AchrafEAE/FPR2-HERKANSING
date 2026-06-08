<?php

namespace Tests\Feature;

use App\Models\Bio;
use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DashboardTest extends TestCase
{
    use RefreshDatabase;

    public function testDashboardShowsBioProgressAndRecentPosts(): void
    {
        $user = User::factory()->create();
        // Create posts and ensure recent posts section is shown
        Post::factory()->create(["user_id" => $user->id, 'title' => 'Recent post A', 'published_at' => now()]);
        Post::factory()->create(["user_id" => $user->id, 'title' => 'Recent post B', 'published_at' => now()]);

        $response = $this->actingAs($user)->get(route('dashboard'));

        $response->assertOk();
        $response->assertSee('Studievoortgang');
        $response->assertSee('75%');
        $response->assertSee('Recente posts');
        $response->assertSee('Recent post A');
        $response->assertSee('Recent post B');
    }
}
