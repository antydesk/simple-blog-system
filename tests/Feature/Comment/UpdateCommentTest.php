<?php

namespace Tests\Feature\Comment;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Passport\Passport;
use Tests\TestCase;

class UpdateCommentTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_update_their_own_comment(): void
    {
        $user = User::factory()->create();
        $post = Post::factory()->create(['user_id' => $user->id]);
        $comment = Comment::factory()->create([
            'user_id' => $user->id,
            'post_id' => $post->id,
        ]);

        Passport::actingAs($user);

        $payload = ['content' => 'Updated Comment'];

        $response = $this->putJson("/api/v1/users/{$user->id}/posts/{$post->id}/comments/{$comment->id}", $payload);

        $response->assertOk()
            ->assertJsonFragment(['content' => 'Updated Comment']);

        $this->assertDatabaseHas('comments', [
            'id' => $comment->id,
            'content' => 'Updated Comment',
        ]);
    }

    public function test_user_cannot_update_someone_elses_comment(): void
    {
        $user = User::factory()->create();
        $otherUser = User::factory()->create();

        $post = Post::factory()->create(['user_id' => $otherUser->id]);
        $comment = Comment::factory()->create([
            'user_id' => $otherUser->id,
            'post_id' => $post->id,
        ]);

        Passport::actingAs($user);

        $response = $this->putJson("/api/v1/users/{$otherUser->id}/posts/{$post->id}/comments/{$comment->id}", [
            'content' => "Trying to update someone else's comment",
        ]);

        $response->assertForbidden();

        $this->assertDatabaseMissing('comments', [
            'id' => $comment->id,
            'content' => "Trying to update someone else's comment",
        ]);
    }

    public function test_guest_cannot_update_comment(): void
    {
        $user = User::factory()->create();
        $post = Post::factory()->create(['user_id' => $user->id]);
        $comment = Comment::factory()->create([
            'user_id' => $user->id,
            'post_id' => $post->id,
        ]);

        $response = $this->putJson("/api/v1/users/{$user->id}/posts/{$post->id}/comments/{$comment->id}", [
            'content' => 'Guest comment',
        ]);

        $response->assertUnauthorized();

        $this->assertDatabaseMissing('comments', [
            'id' => $comment->id,
            'content' => 'Guest comment',
        ]);
    }

    public function test_update_comment_validation_error(): void
    {
        $user = User::factory()->create();
        $post = Post::factory()->create(['user_id' => $user->id]);
        $comment = Comment::factory()->create([
            'user_id' => $user->id,
            'post_id' => $post->id,
        ]);

        Passport::actingAs($user);

        $response = $this->putJson("/api/v1/users/{$user->id}/posts/{$post->id}/comments/{$comment->id}", [
            'content' => '',
        ]);

        $response->assertStatus(422)
            ->assertJsonValidationErrors('content');
    }
}
