<?php

namespace App\GraphQL\Types;

use App\Models\Comment;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Type as GraphQLType;

class CommentType extends GraphQLType
{
    protected $attributes = ['name' => 'Comment', 'model' => Comment::class];

    public function fields(): array
    {
        return [
            'id' => ['type' => Type::nonNull(Type::id())],
            'content' => ['type' => Type::nonNull(Type::string())],
            'user' => ['type' => GraphQL::type('User')],
        ];
    }
}
