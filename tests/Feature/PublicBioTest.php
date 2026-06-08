<?php

namespace Tests\Feature;

use App\Models\Bio;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PublicBioTest extends TestCase
{
    use RefreshDatabase;

    public function testVisitorCanSeePublicBioAndStudyProgress(): void
    {
        $user = User::factory()->create(['name' => 'Achraf']);

        Bio::factory()->create([
            'user_id' => $user->id,
            'headline' => 'Laravel developer',
            'summary' => 'Ik bouw onderhoudbare webapplicaties en dashboards.',
        ]);

        $response = $this->get(route('bio.public', $user));

        $response->assertOk();
        $response->assertSee('Laravel developer');
        $response->assertSee('Ik bouw onderhoudbare webapplicaties en dashboards.');
        $response->assertSee('Studievoortgang');
        $response->assertSeeText('Quarter');
        $response->assertSeeText('Program- & Career Orientation');
        $response->assertSeeText('Totaal');
        $response->assertDontSee('Bio bewerken');
    }
}
