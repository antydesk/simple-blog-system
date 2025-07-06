<?php

namespace Tests\Feature\Like;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Passport\Passport;
use Tests\TestCase;

class CreateLikeCommentTest extends TestCase
{
    use RefreshDatabase;

    public function test_creaete_like_comment(): void
    {
        $user = User::factory()->create();
        Passport::actingAs($user);

        $post = Post::factory()->create(['user_id' => $user->id]);
        $comment = Comment::factory()->create(['user_id' => $user->id,'post_id' => $post->id]);

        $response = $this->postJson("/api/v1/users/$user->id/posts/$post->id/comments/$comment->id/likes");

        $response->assertCreated()
            ->assertJsonStructure([
                'data' => [
                    'id',
                    'user',
                    'likeable',
                    'created_at',
                    'updated_at',
                ]
            ]);

        $this->assertDatabaseHas('likes', [
            'user_id' => $user->id,
            'likeable_id' => $comment->id,
            'likeable_type' => Comment::class,
        ]);
    }


}
