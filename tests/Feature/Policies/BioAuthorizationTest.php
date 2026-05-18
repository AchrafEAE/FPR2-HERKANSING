<?php

declare(strict_types=1);

namespace Tests\Feature\Policies;

use App\Models\User;
use App\Models\Bio;
use App\Enums\UserRole;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

final class BioAuthorizationTest extends TestCase
{
    use RefreshDatabase;

    public function testGuestCanViewBio(): void
    {
        $user = User::factory()->create();
        Bio::factory()->create(['user_id' => $user->id]);

        $response = $this->get('/api/v1/bio');

        $response->assertStatus(401); // Not authenticated
    }

    public function testAuthenticatedUserCanViewBio(): void
    {
        $user = User::factory()->create();
        $bio = Bio::factory()->create(['user_id' => $user->id]);

        $response = $this->actingAs($user)->get('/api/v1/bio');

        $response->assertStatus(200);
        $response->assertJsonPath('data.id', $bio->id);
    }

    public function testOwnerCanUpdateBio(): void
    {
        $owner = User::factory()->create(['role' => UserRole::Owner]);
        $bio = Bio::factory()->create(['user_id' => $owner->id]);

        $response = $this->actingAs($owner)->put('/api/v1/bio', [
            'headline' => 'Updated Headline',
            'summary' => 'Updated Summary',
        ]);

        $response->assertStatus(200);
        $response->assertJsonPath('data.headline', 'Updated Headline');
    }

    public function testEditorCanUpdateBio(): void
    {
        $editor = User::factory()->create(['role' => UserRole::Editor]);
        $bio = Bio::factory()->create(['user_id' => $editor->id]);

        $response = $this->actingAs($editor)->put('/api/v1/bio', [
            'headline' => 'Updated Headline',
            'summary' => 'Updated Summary',
        ]);

        $response->assertStatus(200);
        $response->assertJsonPath('data.headline', 'Updated Headline');
    }

    public function testVisitorCannotUpdateBio(): void
    {
        $visitor = User::factory()->create(['role' => UserRole::Visitor]);
        $bio = Bio::factory()->create(['user_id' => $visitor->id]);

        $response = $this->actingAs($visitor)->put('/api/v1/bio', [
            'headline' => 'Updated Headline',
            'summary' => 'Updated Summary',
        ]);

        $response->assertStatus(403); // Forbidden
    }

    public function testBioRequiresAuthentication(): void
    {
        $response = $this->put('/api/v1/bio', [
            'headline' => 'Updated Headline',
            'summary' => 'Updated Summary',
        ]);

        $response->assertStatus(401); // Unauthorized
    }

    public function testBioValidatesRequiredFields(): void
    {
        $user = User::factory()->create(['role' => UserRole::Owner]);
        Bio::factory()->create(['user_id' => $user->id]);

        $response = $this->actingAs($user)->put('/api/v1/bio', [
            'headline' => '',
            'summary' => '',
        ]);

        $response->assertStatus(422); // Unprocessable Entity
        $response->assertJsonValidationErrors(['headline', 'summary']);
    }

    public function testBioHeadlineHasMaxLength(): void
    {
        $user = User::factory()->create(['role' => UserRole::Owner]);
        Bio::factory()->create(['user_id' => $user->id]);

        $response = $this->actingAs($user)->put('/api/v1/bio', [
            'headline' => str_repeat('a', 121), // Max is 120
            'summary' => 'Summary',
        ]);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors(['headline']);
    }

    public function testBioSummaryHasMaxLength(): void
    {
        $user = User::factory()->create(['role' => UserRole::Owner]);
        Bio::factory()->create(['user_id' => $user->id]);

        $response = $this->actingAs($user)->put('/api/v1/bio', [
            'headline' => 'Headline',
            'summary' => str_repeat('a', 2001), // Max is 2000
        ]);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors(['summary']);
    }

    public function testBioUrlFieldsAreValidated(): void
    {
        $user = User::factory()->create(['role' => UserRole::Owner]);
        Bio::factory()->create(['user_id' => $user->id]);

        $response = $this->actingAs($user)->put('/api/v1/bio', [
            'headline' => 'Headline',
            'summary' => 'Summary',
            'website_url' => 'not-a-url',
            'linkedin_url' => 'not-a-url',
            'github_url' => 'not-a-url',
        ]);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors(['website_url', 'linkedin_url', 'github_url']);
    }
}
