<?php

namespace App\Dto\Api\V1\Comment;

use App\Http\Requests\Api\V1\Comment\CommentUpdateRequest;
use Spatie\LaravelData\Data;

class CommentUpdateDto extends Data
{
    public string $content;

    public int $user_id;

    public ?int $post_id;

    public ?int $parent_id;

    public ?int $id;

    public static function fromRequest(CommentUpdateRequest $request): CommentUpdateDto
    {
        return self::from([
            'content' => $request->getContent(),
            'user_id' => $request->getUserId(),
            'post_id' => $request->getPostId(),
            'parent_id' => $request->getParentId(),
            'id' => $request->getCommentId(),
        ]);
    }
}
