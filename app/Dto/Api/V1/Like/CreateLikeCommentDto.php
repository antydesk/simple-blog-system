<?php

namespace App\Dto\Api\V1\Like;

use App\Http\Requests\Api\V1\Like\LikeCommentCreateRequest;
use Spatie\LaravelData\Data;

class CreateLikeCommentDto extends Data
{
    public int $user_id;
    public int $post_id;
    public int $comment_id;

    public static function fromRequest(LikeCommentCreateRequest $likeCommentCreateRequest): CreateLikeCommentDto
    {
        return self::from([
                'user_id' => $likeCommentCreateRequest->getUserId(),
                'post_id' => $likeCommentCreateRequest->getPostId(),
                'comment_id' => $likeCommentCreateRequest->getCommentId(),
            ]
        );
    }
}
