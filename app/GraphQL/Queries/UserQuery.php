<?php

// app/GraphQL/Queries/UserQuery.php
namespace App\GraphQL\Queries;

use App\Models\User;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Query;

class UserQuery extends Query
{
    protected $attributes = ['name' => 'user'];

    public function type(): Type
    {
        return GraphQL::type('User');
    }

    public function args(): array
    {
        return ['id' => ['type' => Type::nonNull(Type::id())]];
    }

    public function resolve($root, array $args)
    {
        return User::find($args['id']);
    }
}
