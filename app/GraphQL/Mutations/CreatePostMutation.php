<?php

namespace App\GraphQL\Mutations;

use App\Models\Post;
use Closure;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Illuminate\Support\Facades\Auth;
use Rebing\GraphQL\Support\Mutation;
use Rebing\GraphQL\Support\Facades\GraphQL;

class CreatePostMutation extends Mutation
{
    protected $attributes = ['name' => 'createPost'];

    public function type(): Type { return GraphQL::type('Post'); }

    public function args(): array
    {
        return ['input' => ['type' => GraphQL::type('CreatePostInput')]];
    }

    public function authorize(
        $root,
        array $args,
        $ctx,
        ResolveInfo|null $resolveInfo = null,
        Closure|null $getSelectFields = null
    ): bool
    {
        return Auth::check(); // Passport: требуется Bearer токен
    }

    public function rules(array $args = []): array
    {
        return [
            'input.title'   => ['required','string','max:255'],
            'input.content' => ['required','string'],
        ];
    }

    public function resolve($root, array $args)
    {
        $user = Auth::user();
        return Post::create([
            'title'   => $args['input']['title'],
            'content' => $args['input']['content'],
            'user_id' => $user->id,
        ]);
    }
}
