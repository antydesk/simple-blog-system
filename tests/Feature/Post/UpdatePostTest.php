<?php

namespace Tests\Feature\Post;

use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Passport\Passport;
use Tests\TestCase;

class UpdatePostTest extends TestCase
{
    use RefreshDatabase;

    public function test_update_post_success(): void
    {
        $user = User::factory()->create();
        Passport::actingAs($user);

        $post = Post::factory()->create(['user_id' => $user->id]);

        $data = [
            'title' => 'Updated Post Title',
            'content' => 'Updated content for the post.',
        ];

        $response = $this->putJson("/api/v1/users/{$user->id}/posts/{$post->id}", $data);

        $response->assertOk()
            ->assertJson([
                'data' => [
                    'title' => 'Updated Post Title',
                    'content' => 'Updated content for the post.',
                ],
            ]);

        $response->assertJsonStructure([
            'data' => [
                'title',
                'content',
                'created_at',
                'updated_at',
            ]
        ]);
    }

    public function test_update_post_unauthenticated(): void
    {
        $user = User::factory()->create();
        $post = Post::factory()->create(['user_id' => $user->id]);

        $response = $this->putJson("/api/v1/users/{$user->id}/posts/{$post->id}", [
            'title' => 'New Title',
            'content' => 'New content',
        ]);

        $response->assertUnauthorized();
    }

    public function test_update_post_missing_title(): void
    {
        $user = User::factory()->create();
        Passport::actingAs($user);

        $post = Post::factory()->create(['user_id' => $user->id]);

        $response = $this->putJson("/api/v1/users/{$user->id}/posts/{$post->id}", [
            'content' => 'Content without title',
        ]);

        $response->assertUnprocessable()
            ->assertJsonValidationErrors(['title']);
    }

    public function test_update_post_missing_content(): void
    {
        $user = User::factory()->create();
        Passport::actingAs($user);

        $post = Post::factory()->create(['user_id' => $user->id]);

        $response = $this->putJson("/api/v1/users/{$user->id}/posts/{$post->id}", [
            'title' => 'Title without content',
        ]);

        $response->assertUnprocessable()
            ->assertJsonValidationErrors(['content']);
    }

    public function test_update_post_short_title(): void
    {
        $user = User::factory()->create();
        Passport::actingAs($user);

        $post = Post::factory()->create(['user_id' => $user->id]);

        $response = $this->putJson("/api/v1/users/{$user->id}/posts/{$post->id}", [
            'title' => 'Hi',
            'content' => 'Valid content',
        ]);

        $response->assertUnprocessable()
            ->assertJsonValidationErrors(['title']);
    }

    public function test_update_post_short_content(): void
    {
        $user = User::factory()->create();
        Passport::actingAs($user);

        $post = Post::factory()->create(['user_id' => $user->id]);

        $response = $this->putJson("/api/v1/users/{$user->id}/posts/{$post->id}", [
            'title' => 'Valid title',
            'content' => 'abc',
        ]);

        $response->assertUnprocessable()
            ->assertJsonValidationErrors(['content']);
    }

    public function test_update_post_not_owned_by_user(): void
    {
        $user = User::factory()->create();
        $otherUser = User::factory()->create();

        Passport::actingAs($user);

        $post = Post::factory()->create(['user_id' => $otherUser->id]);

        $response = $this->putJson("/api/v1/users/{$user->id}/posts/{$post->id}", [
            'title' => 'New Title',
            'content' => 'New content',
        ]);

        $response->assertForbidden()
        ->assertJson([
            'message' => 'You are not allowed to delete this post.'
        ]);
    }

    public function test_update_post_with_invalid_user_id(): void
    {
        $user = User::factory()->create();
        Passport::actingAs($user);

        $post = Post::factory()->create(['user_id' => $user->id]);

        $invalidUserId = $user->id + 100;

        $response = $this->putJson("/api/v1/users/{$invalidUserId}/posts/{$post->id}", [
            'title' => 'Valid Title',
            'content' => 'Valid content',
        ]);

        $response->assertForbidden();
    }
}
