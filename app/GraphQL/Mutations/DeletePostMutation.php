<?php

// app/GraphQL/Mutations/DeletePostMutation.php
namespace App\GraphQL\Mutations;

use App\Models\Post;
use Closure;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Illuminate\Support\Facades\Auth;
use Rebing\GraphQL\Support\Mutation;

class DeletePostMutation extends Mutation
{
    protected $attributes = ['name' => 'deletePost'];

    public function type(): Type
    {
        return Type::nonNull(Type::boolean());
    }

    public function args(): array
    {
        return ['id' => ['type' => Type::nonNull(Type::id())]];
    }

    public function authorize(
        $root,
        array $args,
        $ctx,
        ResolveInfo|null $resolveInfo = null,
        Closure|null $getSelectFields = null
    ): bool {
        return Auth::check(); // Passport: требуется Bearer токен
    }

    public function rules(array $args = []): array
    {
        return ['id' => ['required', 'integer', 'exists:posts,id']];
    }

    public function resolve($root, array $args)
    {
        $post = Post::findOrFail($args['id']);
        abort_unless($post->user_id === Auth::id(), 403, 'Forbidden');
        return (bool)$post->delete();
    }
}

