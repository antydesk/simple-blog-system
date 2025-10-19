<?php

namespace Tests\Feature\Comment;

use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Passport\Passport;
use Tests\TestCase;

class CreateCommentTest extends TestCase
{
    use RefreshDatabase;

    public function test_create_comment_success(): void
    {
        $user = User::factory()->create();
        Passport::actingAs($user);

        $post = Post::factory()->create(['user_id' => $user->id]);

        $data = [
            'content' => 'Test comment',
        ];

        $response = $this->postJson("/api/v1/users/{$user->id}/posts/{$post->id}/comments", $data);

        $response->assertCreated()
            ->assertJson([
                'data' => [
                    'id' => 1,
                    'content' => 'Test comment',
                    'user' => [
                        'id' => $user->id,
                        'name' => $user->name,
                        'email' => $user->email,
                    ],
                    'post' => [
                        'id' => $post->id,
                        'title' => $post->title,
                        'content' => $post->content,
                        'created_at' => $post->created_at->toJSON(),
                        'updated_at' => $post->updated_at->toJSON(),
                    ],
                ],
            ]);

        $response->assertJsonStructure([
            'data' => [
                'id',
                'content',
                'user' => [
                    'id',
                    'name',
                    'email',
                ],
                'post' => [
                    'id',
                    'title',
                    'content',
                    'created_at',
                    'updated_at',
                ],
                'created_at',
                'updated_at',
            ],
        ]);

    }

    public function test_create_comment_missing_content(): void
    {
        $user = User::factory()->create();
        Passport::actingAs($user);

        $post = Post::factory()->create([
            'user_id' => $user->id,
        ]);

        $response = $this->postJson("/api/v1/users/{$user->id}/posts/{$post->id}/comments", []);

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['content']);
    }

    public function test_create_comment_on_nonexistent_post(): void
    {
        $user = User::factory()->create();
        Passport::actingAs($user);

        $response = $this->postJson("/api/v1/users/{$user->id}/posts/999999/comments", [
            'content' => 'Invalid post ID test',
        ]);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors('post_id');
    }
}
