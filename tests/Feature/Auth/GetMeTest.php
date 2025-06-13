<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Passport\Passport;
use Tests\TestCase;

class GetMeTest extends TestCase
{
    use RefreshDatabase;

    public function test_me_authenticated(): void
    {
        $user = User::factory()->create();
        Passport::actingAs($user);

        $response = $this->getJson('/auth/me');

        $response->assertOk();
        $response->assertJson([
            'data' => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
            ]
        ]);
    }

    public function test_me_unauthenticated(): void
    {
        $response = $this->getJson('/auth/me');

        $response->assertUnauthorized();
    }
}
