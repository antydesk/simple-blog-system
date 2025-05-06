<?php

namespace App\Dto\Api\V1\Post;

use App\Http\Requests\Api\V1\Post\PostCreateRequest;
use Spatie\LaravelData\Data;

class PostCreateDto extends Data
{
    public string $title;
    public string $content;
    public int $user_id;

    public static function fromRequest(PostCreateRequest $request): PostCreateDto
    {
        return self::from([
            'title' => $request->getTitle(),
            'content' => $request->getContent(),
            'user_id' => $request->getUserId(),
        ]);
    }
}
