<?php

namespace Tests\Feature\Comment;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Passport\Passport;
use Tests\TestCase;

class IndexCommentTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_get_paginated_comments_list(): void
    {
        $user = User::factory()->create();
        $post = Post::factory()->create(['user_id' => $user->id]);

        Comment::factory()->count(3)->create([
            'post_id' => $post->id,
            'user_id' => $user->id,
        ]);

        Passport::actingAs($user);

        $response = $this->getJson("/api/v1/users/{$user->id}/posts/{$post->id}/comments");

        $response->assertOk()
            ->assertJsonStructure([
                'data' => [
                    '*' => ['id', 'content', 'created_at', 'updated_at'],
                ],
                'links' => ['first', 'last', 'prev', 'next'],
                'meta' => [
                    'current_page',
                    'from',
                    'last_page',
                    'links',
                    'path',
                    'per_page',
                    'to',
                    'total',
                ],
            ])
            ->assertJsonCount(3, 'data')
            ->assertJsonFragment(['total' => 3]);
    }

    public function test_comments_pagination_with_custom_per_page_and_page(): void
    {
        $user = User::factory()->create();
        $post = Post::factory()->create(['user_id' => $user->id]);
        Comment::factory()->count(5)->create(['user_id' => $user->id, 'post_id' => $post->id]);

        Passport::actingAs($user);

        $page = 2;
        $perPage = 2;
        $response = $this->getJson(
            "/api/v1/users/{$user->id}/posts/{$post->id}/comments?page={$page}&per_page={$perPage}"
        );

        $response->assertOk()
            ->assertJsonPath('meta.current_page', $page)
            ->assertJsonPath('meta.per_page', $perPage)
            ->assertJsonPath('meta.total', 5)
            ->assertJsonCount(2, 'data');
    }

    public function test_comments_list_is_empty(): void
    {
        $user = User::factory()->create();
        $post = Post::factory()->create(['user_id' => $user->id]);

        Passport::actingAs($user);

        $response = $this->getJson("/api/v1/users/{$user->id}/posts/{$post->id}/comments");

        $response->assertOk()
            ->assertJsonCount(0, 'data')
            ->assertJsonPath('meta.total', 0);
    }
}
