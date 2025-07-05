<?php

namespace App\Dto\Api\V1\Like;

use App\Http\Requests\Api\V1\Like\LikeCommentIndexRequest;
use Spatie\LaravelData\Data;

class IndexLikeCommentDto extends Data
{

    public int $user_id;
    public int $post_id;
    public int $comment_id;

    public static function fromRequest(LikeCommentIndexRequest $commentIndexRequest): self
    {
        return self::from([
            'user_id' => $commentIndexRequest->getUserId(),
            'post_id' => $commentIndexRequest->getPostId(),
            'comment_id' => $commentIndexRequest->getCommentId(),
        ]);
    }
}
