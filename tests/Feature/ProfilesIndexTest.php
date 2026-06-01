<?php

namespace Tests\Feature;

use App\Models\Bio;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProfilesIndexTest extends TestCase
{
    use RefreshDatabase;

    public function testProfilesIndexShowsUsersAndBios(): void
    {
        $userWithBio = User::factory()->create(['email' => 'withbio@example.com']);
        Bio::factory()->create(['user_id' => $userWithBio->id, 'headline' => 'Dev', 'summary' => 'Maker of things.']);

        $userNoBio = User::factory()->create(['email' => 'nobio@example.com']);

        $response = $this->get(route('profiles.index'));

        $response->assertOk();
        $response->assertSee('withbio@example.com');
        $response->assertSee('Maker of things.');
        $response->assertSee('nobio@example.com');
    }
}
