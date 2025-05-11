<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RegisterTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     */
    public function test_register_successfully(): void
    {
        $data = [
            'name' => fake()->name,
            'email' => fake()->email,
            'password' => fake()->password,
        ];

        $response = $this->postJson('/auth/register', $data);

        $response->assertCreated();

        $this->assertDatabaseHas('users', ['email' => $data['email']]);

        $response->assertJsonStructure([
            'data' => [
                "access_token",
                "refresh_token",
                "token_type",
                "expires_in"
            ]
        ]);
    }

    public function test_register_fails_when_required_fields_are_missing(): void
    {
        $response = $this->postJson('/auth/register', []);

        $response->assertUnprocessable();
        $response->assertJsonValidationErrors(['name', 'email', 'password']);
    }


    public function test_register_fails_with_invalid_email(): void
    {
        $data = [
            'name' => fake()->name,
            'email' => 'not-an-email',
            'password' => fake()->password,
        ];

        $response = $this->postJson('/auth/register', $data);

        $response->assertUnprocessable();
        $response->assertJsonValidationErrors(['email']);
    }

    public function test_register_fails_with_short_password(): void
    {
        $data = [
            'name' => fake()->name,
            'email' => fake()->email,
            'password' => '123',
        ];

        $response = $this->postJson('/auth/register', $data);

        $response->assertUnprocessable();
        $response->assertJsonValidationErrors(['password']);
    }

    public function test_register_fails_when_email_already_taken(): void
    {
        $email = fake()->unique()->email;

        $user = User::factory()->create(['email' => $email]);

        $data = [
            'name' => fake()->name,
            'email' => $user->email,
            'password' => fake()->password,
        ];

        $response = $this->postJson('/auth/register', $data);

        $response->assertUnprocessable();

        $this->assertEquals(
            'The email has already been taken.',
            $response->json('errors.email.0')
        );
    }
}
