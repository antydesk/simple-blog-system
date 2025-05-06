<?php

namespace App\Dto\Api\V1\Post;

use App\Dto\Api\V1\List\ListDto;
use App\Http\Requests\Api\V1\Post\PostListRequest;

class PostListDto extends ListDto
{
    public ?string $user_id;

    public static function fromRequest(PostListRequest $request): self
    {
        return self::from([
            'perPage' => $request->getPerPage(),
            'page' => $request->getPage(),
            'q' => $request->getQ(),
            'user_id' => $request->getUserId(),
        ]);
    }

}
