<?php

namespace Tests\Feature\Comment;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Passport\Passport;
use Tests\TestCase;

class DeleteCommentTest extends TestCase
{
    use DatabaseMigrations;

    public function test_user_can_delete_their_comment(): void
    {
        $user = User::factory()->create();
        $post = Post::factory()->create(['user_id' => $user->id]);
        $comment = Comment::factory()->create([
            'user_id' => $user->id,
            'post_id' => $post->id,
        ]);

        Passport::actingAs($user);

        $response = $this->deleteJson("/api/v1/users/{$user->id}/posts/{$post->id}/comments/{$comment->id}");

        $response->assertOk()
            ->assertJson([
                'message' => 'Comment deleted successfully.',
            ]);
        $this->assertDatabaseMissing('comments', ['id' => $comment->id]);
    }

    public function test_user_cannot_delete_someone_elses_comment(): void
    {
        $user = User::factory()->create();
        $otherUser = User::factory()->create();

        $post = Post::factory()->create(['user_id' => $otherUser->id]);
        $comment = Comment::factory()->create([
            'user_id' => $otherUser->id,
            'post_id' => $post->id,
        ]);

        Passport::actingAs($user);

        $response = $this->deleteJson("/api/v1/users/{$otherUser->id}/posts/{$post->id}/comments/{$comment->id}");

        $response->assertForbidden();
    }

    public function test_deleting_non_existent_comment_returns_404(): void
    {
        $user = User::factory()->create();
        $post = Post::factory()->create(['user_id' => $user->id]);

        Passport::actingAs($user);

        $response = $this->deleteJson("/api/v1/users/{$user->id}/posts/{$post->id}/comments/999");

        $response->assertNotFound();
    }

    public function test_guest_cannot_delete_comment(): void
    {
        $user = User::factory()->create();
        $post = Post::factory()->create(['user_id' => $user->id]);
        $comment = Comment::factory()->create([
            'user_id' => $user->id,
            'post_id' => $post->id,
        ]);

        $response = $this->deleteJson("/api/v1/users/{$user->id}/posts/{$post->id}/comments/{$comment->id}");

        $response->assertUnauthorized();
    }
}
