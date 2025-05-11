<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LoginTest extends TestCase
{
    use RefreshDatabase;

    public function test_login_returns_token(): void
    {
        $password = fake()->password;

        $user = User::factory()->create([
            'password' => bcrypt($password),
        ]);

        $data = [
            'email' => $user->email,
            'password' => $password,
        ];

        $response = $this->postJson('/auth/login', $data);

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

    public function test_login_fails_with_invalid_password(): void
    {
        $user = User::factory()->create([
            'password' => bcrypt('correct-password'),
        ]);

        $data = [
            'email' => $user->email,
            'password' => 'wrong-password',
        ];

        $response = $this->postJson('/auth/login', $data);

        $response->assertStatus(400);

        $response->assertJson([
            'error' => 'invalid_grant',
            'message' => 'The user credentials were incorrect.',
        ]);
    }

}
