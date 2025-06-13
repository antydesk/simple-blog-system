<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LogoutTest extends TestCase
{
    use RefreshDatabase;

    public function test_logout(): void
    {
        $password = fake()->password;

        $user = User::factory()->create([
            'password' => bcrypt($password),
        ]);

        $data = [
            'email' => $user->email,
            'password' => $password,
        ];

        $userAuthData = $this->postJson('/auth/login', $data);

        $tokenData = json_decode($userAuthData->getContent(), true);

        $response = $this->withHeader('Authorization', 'Bearer ' . $tokenData['data']['access_token'])->postJson(
            '/auth/logout'
        );

        $response->assertNoContent();
    }
}
