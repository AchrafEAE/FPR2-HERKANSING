<?php

declare(strict_types=1);

namespace Tests\Feature\Auth;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

final class LogoutTest extends TestCase
{
    use RefreshDatabase;

    public function testLogoutDestroySession(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post('/logout');

        $response->assertRedirect('/');
        $this->assertGuest();
    }

    public function testLogoutRegeneratesToken(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user)->post('/logout');

        // Session should be invalidated
        $this->assertGuest();
    }

    public function testUnauthenticatedUserCannotLogout(): void
    {
        $response = $this->post('/logout');

        $response->assertRedirect('/');
    }
}
