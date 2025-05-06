<?php

namespace App\Dto\Api\V1\Comment;

use App\Http\Requests\Api\V1\Comment\CommentShowRequest;
use Spatie\LaravelData\Data;

class CommentShowDto extends Data
{
    public int $user_id;
    public ?int $post_id;
    public int $id;

    public static function fromRequest(CommentShowRequest $request): CommentShowDto
    {
        return self::from([
            'user_id' => $request->getUserId(),
            'post_id' => $request->getPostId(),
            'id' => $request->getCommentId(),
        ]);
    }

}
