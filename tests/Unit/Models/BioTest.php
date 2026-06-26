<?php

namespace Tests\Unit\Models;

use App\Models\Bio;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BioTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_belongs_to_a_user()
    {
        $user = User::factory()->create();
        $bio = Bio::factory()->make(['user_id' => $user->id]);
        $bio->save();
        $this->assertInstanceOf(User::class, $bio->user);
        $this->assertEquals($user->id, $bio->user->id);
    }
}
