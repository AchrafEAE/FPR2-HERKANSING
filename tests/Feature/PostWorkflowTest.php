<?php

namespace Tests\Feature;

use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PostWorkflowTest extends TestCase
{
    use RefreshDatabase;

    public function testAuthenticatedUserCanCreatePublishAndViewPosts(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->post(route('posts.store'), [
                'title' => 'My first workflow post',
                'body' => 'This is a draft that will be published later.',
            ])
            ->assertRedirect();

        $post = Post::query()->where('user_id', $user->id)->firstOrFail();

        $this->actingAs($user)
            ->get(route('posts.index'))
            ->assertOk()
            ->assertSee('My first workflow post');

        $this->actingAs($user)
            ->post(route('posts.publish', $post))
            ->assertRedirect(route('posts.show', $post));

        $post->refresh();

        $this->assertNotNull($post->published_at);
        $this->assertNotNull($post->published_at);

        $this->actingAs($user)
            ->get(route('posts.show', $post))
            ->assertOk()
            ->assertSee('My first workflow post');
    }
}
