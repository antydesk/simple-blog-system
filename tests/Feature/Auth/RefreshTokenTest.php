<?php

namespace Tests\Feature\Auth;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RefreshTokenTest extends TestCase
{
    use RefreshDatabase;

    public function test_refresh_token(): void
    {
        $data = [
            'name' => fake()->name,
            'email' => fake()->email,
            'password' => fake()->password,
        ];

        $userAuthData = $this->postJson('/auth/register', $data);

        $userAuthData = json_decode($userAuthData->getContent(), true);

        $response = $this->postJson('/auth/refresh-token', [
            'refresh_token' => $userAuthData['data']['refresh_token'],
        ]);

        $response->assertOk();
        $response->assertJsonStructure([
            'data' => [
                "access_token",
                "refresh_token",
                "token_type",
                "expires_in"
            ]
        ]);
    }
}
