<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use Laravel\Passport\Passport;
use Tests\TestCase;

class GetMeTest extends TestCase
{
    /**
     * A basic feature test example.
     */
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
