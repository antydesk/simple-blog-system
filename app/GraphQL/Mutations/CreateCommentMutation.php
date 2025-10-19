<?php

namespace App\GraphQL\Mutations;

use App\Models\Comment;
use Closure;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Illuminate\Support\Facades\Auth;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Mutation;

class CreateCommentMutation extends Mutation
{
    protected $attributes = ['name' => 'createComment'];

    public function type(): Type
    {
        return GraphQL::type('Comment');
    }

    public function args(): array
    {
        return ['input' => ['type' => GraphQL::type('CreateCommentInput')]];
    }

    public function authorize(
        $root,
        array $args,
        $ctx,
        ?ResolveInfo $resolveInfo = null,
        ?Closure $getSelectFields = null
    ): bool {
        return Auth::check(); // Passport: требуется Bearer токен
    }

    public function rules(array $args = []): array
    {
        return [
            'input.post_id' => ['required', 'integer', 'exists:posts,id'],
            'input.content' => ['required', 'string'],
        ];
    }

    public function resolve($root, array $args)
    {
        $user = Auth::user();

        return Comment::create([
            'post_id' => $args['input']['post_id'],
            'user_id' => $user->id,
            'content' => $args['input']['content'],
        ]);
    }
}
