<?php

namespace Tests\Feature;

use App\Models\Bio;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BioCrudTest extends TestCase
{
    use RefreshDatabase;

    public function testAuthenticatedUserCanOpenBioEditor(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->get(route('bio.edit'))
            ->assertOk()
            ->assertSee('Bio beheren');
    }

    public function testAuthenticatedUserCanSaveBio(): void
    {
        $user = User::factory()->create();

        $payload = [
            'headline' => 'Laravel developer',
            'summary' => 'Ik bouw CRUD flows, dashboards en deploybare apps.',
            'location' => 'Amsterdam',
            'availability' => 'Open for work',
            'website_url' => 'https://example.com',
            'linkedin_url' => 'https://linkedin.com/in/example',
            'github_url' => 'https://github.com/example',
            'years_experience' => 4,
        ];

        $this->actingAs($user)
            ->put(route('bio.update'), $payload)
            ->assertRedirect(route('bio.edit'));

        $this->assertDatabaseHas('bios', [
            'user_id' => $user->id,
            'headline' => 'Laravel developer',
            'location' => 'Amsterdam',
        ]);

        $this->assertNotNull(Bio::query()->where('user_id', $user->id)->first());
    }
}
