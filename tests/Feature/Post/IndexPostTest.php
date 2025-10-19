<?php

namespace Tests\Feature\Post;

use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Testing\Fluent\AssertableJson;
use Laravel\Passport\Passport;
use Tests\TestCase;

class IndexPostTest extends TestCase
{
    use RefreshDatabase;

    public function test_get_posts_success(): void
    {
        $user = User::factory()->create();
        Passport::actingAs($user);

        Post::factory()->count(3)->create(['user_id' => $user->id]);

        $response = $this->getJson("/api/v1/users/{$user->id}/posts");

        $response->assertOk()
            ->assertJsonStructure([
                'data' => [
                    '*' => [
                        'id',
                        'title',
                        'content',
                        'created_at',
                        'updated_at',
                    ],
                ],
            ]);

        $response->assertJson(fn (AssertableJson $json) => $json->has('data', 3)
            ->has('data.0.id')
            ->has('data.0.title')
            ->has('data.0.content')
            ->etc()
        );
    }

    public function test_get_posts_unauthenticated(): void
    {
        $user = User::factory()->create();

        $response = $this->getJson("/api/v1/users/{$user->id}/posts");

        $response->assertUnauthorized();
    }

    public function test_get_posts_of_another_user_forbidden(): void
    {
        $user = User::factory()->create();
        $otherUser = User::factory()->create();

        Passport::actingAs($user);

        Post::factory()->count(2)->create(['user_id' => $otherUser->id]);

        $response = $this->getJson("/api/v1/users/{$otherUser->id}/posts");

        $response->assertForbidden();
    }
}
