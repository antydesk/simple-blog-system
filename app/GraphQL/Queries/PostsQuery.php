<?php

namespace App\GraphQL\Queries;

use App\Models\Post;
use Closure;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Query;
use Rebing\GraphQL\Support\SelectFields;

class PostsQuery extends Query
{
    protected $attributes = ['name' => 'posts'];

    public function type(): Type
    {
        return Type::listOf(GraphQL::type('Post'));
    }

    public function args(): array
    {
        return [
            'user_id' => ['type' => Type::id()],
            'search' => ['type' => Type::string()],
            'limit' => ['type' => Type::int(), 'defaultValue' => 20],
            'offset' => ['type' => Type::int(), 'defaultValue' => 0],
        ];
    }

    public function rules(array $args = []): array
    {
        return [
            'user_id' => ['sometimes', 'integer', 'exists:users,id'],
            'limit' => ['integer', 'min:1', 'max:100'],
            'offset' => ['integer', 'min:0'],
        ];
    }

    public function resolve($root, array $args, $ctx, ResolveInfo $info, Closure $getSelectFields)
    {
        /** @var SelectFields $fields */
        $fields = $getSelectFields();
        $select = $fields->getSelect();
        $relations = $fields->getRelations(); // подгрузит 'user', 'comments', если они в запросе

        $q = Post::query()
            ->select($select ?: ['*'])
            ->with($relations);

        if (!empty($args['user_id'])) {
            $q->where('user_id', $args['user_id']);
        }
        if (!empty($args['search'])) {
            // для PostgreSQL: ILIKE; для MySQL — LIKE
            $q->where('title', 'ILIKE', '%' . $args['search'] . '%');
        }

        return $q->offset($args['offset'])->limit($args['limit'])->get();
    }
}

