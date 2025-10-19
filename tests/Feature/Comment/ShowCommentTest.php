<?php

namespace Tests\Feature\Comment;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Passport\Passport;
use Tests\TestCase;

class ShowCommentTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_view_their_comment(): void
    {
        $user = User::factory()->create();
        $post = Post::factory()->create(['user_id' => $user->id]);

        $comment = Comment::factory()->create([
            'user_id' => $user->id,
            'post_id' => $post->id,
        ]);

        Passport::actingAs($user);

        $response = $this->getJson("/api/v1/users/{$user->id}/posts/{$post->id}/comments/{$comment->id}");

        $response->assertOk()
            ->assertJsonStructure([
                'data' => [
                    'id',
                    'content',
                    'created_at',
                    'updated_at',
                ],
            ])
            ->assertJsonFragment([
                'id' => $comment->id,
                'content' => $comment->content,
            ]);
    }

    public function test_viewing_non_existent_comment_returns_404(): void
    {
        $user = User::factory()->create();
        $post = Post::factory()->create(['user_id' => $user->id]);

        Passport::actingAs($user);

        $response = $this->getJson("/api/v1/users/{$user->id}/posts/{$post->id}/comments/999");

        $response->assertNotFound();
    }

    public function test_user_cannot_view_someone_elses_comment(): void
    {
        $user = User::factory()->create();
        $otherUser = User::factory()->create();

        $post = Post::factory()->create(['user_id' => $otherUser->id]);
        $comment = Comment::factory()->create([
            'user_id' => $otherUser->id,
            'post_id' => $post->id,
        ]);

        Passport::actingAs($user);

        $response = $this->getJson("/api/v1/users/{$otherUser->id}/posts/{$post->id}/comments/{$comment->id}");

        $response->assertForbidden();
    }

    public function test_guest_cannot_view_comment(): void
    {
        $user = User::factory()->create();
        $post = Post::factory()->create(['user_id' => $user->id]);
        $comment = Comment::factory()->create([
            'user_id' => $user->id,
            'post_id' => $post->id,
        ]);

        $response = $this->getJson("/api/v1/users/{$user->id}/posts/{$post->id}/comments/{$comment->id}");

        $response->assertUnauthorized();
    }
}
