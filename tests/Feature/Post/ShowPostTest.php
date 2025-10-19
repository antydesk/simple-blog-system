<?php

namespace Tests\Feature\Post;

use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Passport\Passport;
use Tests\TestCase;

class ShowPostTest extends TestCase
{
    use RefreshDatabase;

    public function test_get_single_post_success(): void
    {
        $user = User::factory()->create();
        Passport::actingAs($user);

        $post = Post::factory()->create(['user_id' => $user->id]);

        $response = $this->getJson("/api/v1/users/{$user->id}/posts/{$post->id}");

        $response->assertOk()
            ->assertJson([
                'data' => [
                    'id' => $post->id,
                    'title' => $post->title,
                    'content' => $post->content,
                    'user' => [
                        'id' => $post->user_id,
                        'name' => $post->user->name,
                        'email' => $post->user->email,
                    ],
                ],
            ]);

        $response->assertJsonStructure([
            'data' => [
                'id',
                'title',
                'content',
                'created_at',
                'updated_at',
                'user' => [
                    'id',
                    'name',
                    'email',
                ],
            ],
        ]);
    }
}
