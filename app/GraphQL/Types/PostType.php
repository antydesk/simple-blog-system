<?php

namespace App\GraphQL\Types;

use App\Models\Post;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Type as GraphQLType;

class PostType extends GraphQLType
{
    protected $attributes = [
        'name' => 'Post',
        'model' => Post::class,
    ];

    public function fields(): array
    {
        return [
            'id' => ['type' => Type::nonNull(Type::id())],
            'title' => ['type' => Type::nonNull(Type::string())],
            'content' => ['type' => Type::nonNull(Type::string())],

            // belongsTo User
            'user' => [
                'type' => GraphQL::type('User'),
                'resolve' => fn(Post $post) => $post->user,
            ],

            // hasMany comments
            'comments' => [
                'type' => Type::listOf(GraphQL::type('Comment')),
                'resolve' => fn(Post $post) => $post->comments()->with('user')->get(),
            ],

            // подсчёт лайков
            'likesCount' => [
                'type' => Type::nonNull(Type::int()),
                'resolve' => fn(Post $post) => $post->likes()->count(),
            ],
        ];
    }
}

