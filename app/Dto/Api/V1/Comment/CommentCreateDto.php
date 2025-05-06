<?php

namespace App\Dto\Api\V1\Comment;

use App\Http\Requests\Api\V1\Comment\CommentCreateRequest;
use Spatie\LaravelData\Data;

class CommentCreateDto extends Data
{
    public string $content;
    public int $user_id;
    public ?int $post_id;
    public ?int $parent_id;

    public static function fromRequest(CommentCreateRequest $request): CommentCreateDto
    {
        return self::from([
            'content' => $request->getContent(),
            'user_id' => $request->getUserId(),
            'post_id' => $request->getPostId(),
            'parent_id' => $request->getParentId(),
        ]);
    }

}
