<?php

namespace App\GraphQL\Mutations;

use App\Models\Post;
use Closure;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Illuminate\Support\Facades\Auth;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Mutation;

class UpdatePostMutation extends Mutation
{
    protected $attributes = ['name' => 'updatePost'];

    public function type(): Type
    {
        return GraphQL::type('Post');
    }

    public function args(): array
    {
        return [
            'id' => ['type' => Type::nonNull(Type::id())],
            'input' => ['type' => GraphQL::type('UpdatePostInput')],
        ];
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
        return [
            'id' => ['required', 'integer', 'exists:posts,id'],
            'input.title' => ['sometimes', 'string', 'max:255'],
            'input.content' => ['sometimes', 'string'],
        ];
    }

    public function resolve($root, array $args)
    {
        $post = Post::findOrFail($args['id']);
        abort_unless($post->user_id === Auth::id(), 403, 'Forbidden');

        $post->fill($args['input'] ?? [])->save();
        return $post->fresh();
    }
}

