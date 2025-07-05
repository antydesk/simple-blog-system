<?php

namespace Tests\Feature\Like;

use App\Models\Like;
use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Passport\Passport;
use Tests\TestCase;

class IndexLikeTest extends TestCase
{
    use RefreshDatabase;

    public function test_index_like(): void
    {
        $user = User::factory()->create();
        Passport::actingAs($user);

        $post = Post::factory()->create(['user_id' => $user->id]);

        $like_1 = Like::factory()->create(
            ['likeable_id' => $post->id, 'likeable_type' => Post::class, 'user_id' => $user->id]
        );

        $like_2 = Like::factory()->create(
            ['likeable_id' => $post->id, 'likeable_type' => Post::class, 'user_id' => $user->id]
        );

        $response = $this->getJson("/api/v1/users/{$user->id}/posts/{$post->id}/likes");

        $response->assertOk()
            ->assertJsonCount(2, 'data')
            ->assertJson([
                'data' => [
                    [
                        'id' => $like_1->id,
                        'user' => [
                            'id' => $user->id,
                            'name' => $user->name,
                            'email' => $user->email,
                        ],
                        'created_at' => $like_1->created_at->toDateTimeString(),
                        'updated_at' => $like_1->updated_at->toDateTimeString(),
                    ],
                    [
                        'id' => $like_2->id,
                        'user' => [
                            'id' => $user->id,
                            'name' => $user->name,
                            'email' => $user->email,
                        ],
                        'created_at' => $like_2->created_at->toDateTimeString(),
                        'updated_at' => $like_2->updated_at->toDateTimeString(),
                    ]
                ],
            ]);
    }
}
