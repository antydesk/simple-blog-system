<?php

namespace App\Dto\Api\V1\Like;

use App\Http\Requests\Api\V1\Like\LikeIndexRequest;
use Spatie\LaravelData\Data;

class IndexLikeDto extends Data
{

    public int $user_id;
    public int $post_id;

    public static function fromRequest(LikeIndexRequest $likeCreateRequest): self
    {
        return self::from([
            'user_id' => $likeCreateRequest->getUserId(),
            'post_id' => $likeCreateRequest->getPostId(),
        ]);
    }
}
