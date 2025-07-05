<?php

namespace App\Dto\Api\V1\Like;

use App\Http\Requests\Api\V1\Like\LikeCreateRequest;
use Spatie\LaravelData\Data;

class CreateLikeDto extends Data
{
    public int $user_id;
    public int $post_id;

    public static function fromRequest(LikeCreateRequest $likeCreateRequest): CreateLikeDto
    {
        return self::from([
                'user_id' => $likeCreateRequest->getUserId(),
                'post_id' => $likeCreateRequest->getPostId(),
            ]
        );
    }
}
