<?php

namespace App\GraphQL\Queries;

use App\Models\Post;
use Closure;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Query;
use Rebing\GraphQL\Support\SelectFields;

class PostQuery extends Query
{
    protected $attributes = ['name' => 'post'];

    public function type(): Type
    {
        return GraphQL::type('Post');
    }

    public function args(): array
    {
        return [
            'id' => ['type' => Type::nonNull(Type::id())],
        ];
    }

    public function resolve($root, array $args, $ctx, ResolveInfo $info, Closure $getSelectFields)
    {
        /** @var SelectFields $fields */
        $fields = $getSelectFields();
        $select = $fields->getSelect();     // какие столбцы верхнего уровня реально запросили
        $relations = $fields->getRelations();  // какие вложенные поля (связи) реально запросили

        if (array_key_exists('author', $relations)) {
            $relations['user'] = $relations['author'];
            unset($relations['author']);
        }

        $baseSelect = empty($select) ? ['*'] : array_unique(array_merge($select, ['id', 'user_id']));

        return Post::query()
            ->select($baseSelect)
            ->with($relations)
            ->find($args['id']);
    }
}
