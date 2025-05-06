<?php

namespace App\Dto\Api\V1\Post;

use App\Http\Requests\Api\V1\Post\PostCreateRequest;
use App\Http\Requests\Api\V1\Post\PostUpdateRequest;
use Spatie\LaravelData\Data;

class PostUpdateDto extends Data
{
    public string $title;
    public string $content;
    public int $user_id;
    public int $id;

    public static function fromRequest(PostUpdateRequest $request): PostUpdateDto
    {
        return self::from([
            'title' => $request->getTitle(),
            'content' => $request->getContent(),
            'id' => $request->getPostId(),
            'user_id' => $request->getUserId(),
        ]);
    }
}
