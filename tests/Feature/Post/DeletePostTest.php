<?php

namespace Tests\Feature\Post;

use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Passport\Passport;
use Tests\TestCase;

class DeletePostTest extends TestCase
{
    use RefreshDatabase;

    public function test_delete_post_success(): void
    {
        $user = User::factory()->create();
        Passport::actingAs($user);

        $post = Post::factory()->create(['user_id' => $user->id]);

        $response = $this->deleteJson("/api/v1/users/{$user->id}/posts/{$post->id}");

        $response->assertStatus(200)
            ->assertJson([
                'message' => 'Post deleted successfully',
            ]);

        $this->assertDatabaseMissing('posts', ['id' => $post->id]);
    }

    public function test_delete_post_unauthenticated(): void
    {
        $user = User::factory()->create();
        $post = Post::factory()->create(['user_id' => $user->id]);

        $response = $this->deleteJson("/api/v1/users/{$user->id}/posts/{$post->id}");

        $response->assertUnauthorized();
    }

    public function test_delete_nonexistent_post(): void
    {
        $user = User::factory()->create();
        Passport::actingAs($user);

        $response = $this->deleteJson("/api/v1/users/{$user->id}/posts/999999");

        $response->assertNotFound()
            ->assertJson([
                'message' => 'Post not found',
            ]);
    }

    public function test_delete_post_user_id_mismatch(): void
    {
        $owner = User::factory()->create();
        $post = Post::factory()->create(['user_id' => $owner->id]);

        $anotherUser = User::factory()->create();
        Passport::actingAs($anotherUser);

        $response = $this->deleteJson("/api/v1/users/{$anotherUser->id}/posts/{$post->id}");
        $response->assertForbidden();
    }
}
