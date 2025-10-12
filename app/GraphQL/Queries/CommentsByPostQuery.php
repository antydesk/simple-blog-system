<?php

namespace App\GraphQL\Queries;

use App\Models\Comment;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Query;

class CommentsByPostQuery extends Query
{
    protected $attributes = ['name' => 'commentsByPost'];

    public function type(): Type
    {
        return Type::listOf(GraphQL::type('Comment'));
    }

    public function args(): array
    {
        return [
            'post_id' => ['type' => Type::nonNull(Type::id())],
            'limit' => ['type' => Type::int(), 'defaultValue' => 50],
            'offset' => ['type' => Type::int(), 'defaultValue' => 0],
        ];
    }

    public function rules(array $args = []): array
    {
        return [
            'post_id' => ['required', 'integer', 'exists:posts,id'],
            'limit' => ['integer', 'min:1', 'max:100'],
            'offset' => ['integer', 'min:0'],
        ];
    }

    public function resolve($root, array $args)
    {
        return Comment::query()
            ->with('user')
            ->where('post_id', $args['post_id'])
            ->offset($args['offset'])->limit($args['limit'])
            ->orderBy('id', 'desc')
            ->get();
    }
}

