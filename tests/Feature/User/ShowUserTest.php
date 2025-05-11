<?php

namespace Tests\Feature\User;

use App\Http\Resources\Api\V1\User\UserResource;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Passport\Passport;
use Tests\TestCase;

class ShowUserTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_show_user(): void
    {
        $user = User::factory()->create();
        Passport::actingAs($user);

        $response = $this->getJson("/api/v1/users/{$user->id}");

        $response->assertOk();
        $response->assertJson(new UserResource($user)->response()->getData(true));
    }
}
