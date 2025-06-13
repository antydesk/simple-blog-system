<?php

namespace Tests\Feature\Comment;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Passport\Passport;
use Tests\TestCase;

class GetChildrenCommentsTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_get_children_comments(): void
    {
        $user = User::factory()->create();
        $post = Post::factory()->create(['user_id' => $user->id]);
        $parentComment = Comment::factory()->create([
            'post_id' => $post->id,
            'user_id' => $user->id,
        ]);

        Comment::factory()->count(3)->create([
            'post_id' => $post->id,
            'user_id' => $user->id,
            'parent_id' => $parentComment->id,
        ]);

        Passport::actingAs($user);

        $response = $this->getJson(
            "/api/v1/users/{$user->id}/posts/{$post->id}/comments/{$parentComment->id}/children"
        );

        $response->assertOk()
            ->assertJsonCount(3, 'data')
            ->assertJsonStructure([
                'data' => [
                    '*' => ['id', 'content', 'created_at', 'updated_at'],
                ],
                'links' => [
                    'first',
                    'last',
                    'prev',
                    'next',
                ],
                'meta' => [
                    'current_page',
                    'from',
                    'last_page',
                    'links' => [
                        '*' => ['url', 'label', 'active']
                    ],
                    'path',
                    'per_page',
                    'to',
                    'total',
                ],
            ]);
    }

    public function test_children_comments_pagination_works(): void
    {
        $user = User::factory()->create();
        $post = Post::factory()->create(['user_id' => $user->id]);
        $parent = Comment::factory()->create([
            'post_id' => $post->id,
            'user_id' => $user->id,
        ]);

        Comment::factory()->count(30)->create([
            'post_id' => $post->id,
            'user_id' => $user->id,
            'parent_id' => $parent->id,
        ]);

        Passport::actingAs($user);

        $response = $this->getJson(
            "/api/v1/users/{$user->id}/posts/{$post->id}/comments/{$parent->id}/children?per_page=10&page=2"
        );

        $response->assertOk()
            ->assertJsonPath('meta.current_page', 2)
            ->assertJsonPath('meta.per_page', 10)
            ->assertJsonCount(10, 'data');
    }


}
