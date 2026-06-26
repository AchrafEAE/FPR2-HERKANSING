<?php

namespace Tests\Unit\Models;

use App\Models\User;
use App\Models\Post;
use App\Models\Bio;
use App\Enums\UserRole;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_has_a_bio_relationship()
    {
        $user = User::factory()->create();
        $bio = Bio::factory()->make();
        $user->bio()->save($bio);
        $this->assertInstanceOf(Bio::class, $user->bio);
    }

    /** @test */
    public function it_has_many_posts()
    {
        $user = User::factory()->create();
        $post = Post::factory()->make();
        $user->posts()->save($post);
        $this->assertCount(1, $user->posts);
        $this->assertTrue($user->posts->first()->is($post));
    }

    /** @test */
    public function it_can_check_roles()
    {
        $user = User::factory()->create(['role' => UserRole::Owner]);
        $this->assertTrue($user->hasRole(UserRole::Owner));
        $this->assertFalse($user->hasRole(UserRole::Visitor));
        $this->assertTrue($user->hasAnyRole([UserRole::Owner, UserRole::Visitor]));
    }
}
