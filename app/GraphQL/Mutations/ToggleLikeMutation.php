<?php

namespace App\GraphQL\Mutations;

use App\Models\Like;
use App\Models\Post;
use Closure;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Illuminate\Support\Facades\Auth;
use Rebing\GraphQL\Support\Mutation;


class ToggleLikeMutation extends Mutation
{
    protected $attributes = ['name' => 'toggleLike'];

    public function type(): Type
    {
        return Type::nonNull(Type::boolean());
    }

    public function args(): array
    {
        return ['post_id' => ['type' => Type::nonNull(Type::id())]];
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
        return ['post_id' => ['required', 'integer', 'exists:posts,id']];
    }

    public function resolve($root, array $args)
    {
        $userId = Auth::id();
        $post = Post::findOrFail($args['post_id']);

        $like = Like::where('user_id', $userId)
            ->where('likeable_id', $post->id)
            ->where('likeable_type', Post::class)
            ->first();

        if ($like) {
            $like->delete();
            return false;
        }

        $post->likes()->create(['user_id' => $userId]);
        return true;
    }
}

