<?php

namespace Tests\Feature\Post;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Passport\Passport;
use Tests\TestCase;

class CreatePostTest extends TestCase
{
    use RefreshDatabase;

    public function test_create_post_success(): void
    {
        $user = User::factory()->create();
        Passport::actingAs($user);

        $data = [
            'title' => 'New Post Title',
            'content' => 'Content for the new post.',
        ];

        $response = $this->postJson("/api/v1/users/{$user->id}/posts", $data);

        $response->assertCreated()
            ->assertJson([
                'data' => [
                    'title' => 'New Post Title',
                    'content' => 'Content for the new post.',
                ],
            ]);

        $response->assertJsonStructure([
            'data' => [
                'title',
                'content',
                'created_at',
                'updated_at',
            ],
        ]);
    }

    public function test_create_post_unauthenticated(): void
    {
        $user = User::factory()->create();

        $response = $this->postJson("/api/v1/users/{$user->id}/posts", [
            'title' => 'Title',
            'content' => 'Some content',
        ]);

        $response->assertUnauthorized();
    }

    public function test_create_post_without_title(): void
    {
        $user = User::factory()->create();
        Passport::actingAs($user);

        $response = $this->postJson("/api/v1/users/{$user->id}/posts", [
            'content' => 'Some content',
        ]);

        $response->assertUnprocessable()
            ->assertJsonValidationErrors(['title']);
    }

    public function test_create_post_with_short_title(): void
    {
        $user = User::factory()->create();
        Passport::actingAs($user);

        $response = $this->postJson("/api/v1/users/{$user->id}/posts", [
            'title' => 'Hi',
            'content' => 'Some content',
        ]);

        $response->assertUnprocessable()
            ->assertJsonValidationErrors(['title']);
    }

    public function test_create_post_without_content(): void
    {
        $user = User::factory()->create();
        Passport::actingAs($user);

        $response = $this->postJson("/api/v1/users/{$user->id}/posts", [
            'title' => 'Valid Title',
        ]);

        $response->assertUnprocessable()
            ->assertJsonValidationErrors(['content']);
    }

    public function test_create_post_with_short_content(): void
    {
        $user = User::factory()->create();
        Passport::actingAs($user);

        $response = $this->postJson("/api/v1/users/{$user->id}/posts", [
            'title' => 'Valid Title',
            'content' => 'abc',
        ]);

        $response->assertUnprocessable()
            ->assertJsonValidationErrors(['content']);
    }
}
