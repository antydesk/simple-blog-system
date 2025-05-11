<?php

namespace Tests\Feature\User;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Passport\Passport;
use Tests\TestCase;

class DeleteUserTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_delete_user(): void
    {
        $user = User::factory()->create();
        Passport::actingAs($user);

        $response = $this->deleteJson("/api/v1/users/{$user->id}");

        $response->assertOk();

        $this->assertDatabaseMissing('users', ['id' => $user->id]);

        $this->assertEquals(
            "User deleted successfully",
            $response->json('message')
        );
    }
}
