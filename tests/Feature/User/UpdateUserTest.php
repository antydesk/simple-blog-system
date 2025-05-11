<?php

namespace Tests\Feature\User;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Passport\Passport;
use Tests\TestCase;

class UpdateUserTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_update_user(): void
    {
        $user = User::factory()->create();
        Passport::actingAs($user);

        $data = [
            'name' => 'Updated Name',
            'email' => 'updated@example.com',
        ];

        $response = $this->putJson("/api/v1/users/{$user->id}", $data);

        $response->assertOk()
            ->assertJsonFragment($data);

        $this->assertDatabaseHas('users', [
            'id' => $user->id,
            'name' => $data['name'],
            'email' => $data['email'],
        ]);
    }

    public function test_validation_fails_on_invalid_name(): void
    {
        $user = User::factory()->create();
        Passport::actingAs($user);

        $data = [
            'name' => 'A',
            'email' => 'valid@example.com',
        ];

        $response = $this->putJson("/api/v1/users/{$user->id}", $data);

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['name']);
    }

    public function test_validation_fails_on_invalid_email(): void
    {
        $user = User::factory()->create();
        Passport::actingAs($user);

        $data = [
            'name' => 'Valid Name',
            'email' => 'invalid-email',
        ];

        $response = $this->putJson("/api/v1/users/{$user->id}", $data);

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['email']);
    }
}
