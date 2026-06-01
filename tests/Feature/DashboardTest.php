<?php

namespace Tests\Feature;

use App\Enums\PostStatus;
use App\Models\Bio;
use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DashboardTest extends TestCase
{
    use RefreshDatabase;

    public function testDashboardShowsBioAndPostStats(): void
    {
        $user = User::factory()->create();

        // Create a bio for the user
        Bio::factory()->create(['user_id' => $user->id]);

        // Create posts with different statuses
        Post::factory()->count(2)->create(["user_id" => $user->id, 'status' => PostStatus::Draft->value]);
        Post::factory()->count(3)->create(["user_id" => $user->id, 'status' => PostStatus::Published->value]);

        $response = $this->actingAs($user)->get(route('dashboard'));

        $response->assertOk();
        $response->assertSee('Actief profiel aanwezig');
        $response->assertSee('2 drafts in je workflow.');
        $response->assertSee('3 posts live gezet.');
    }
}
