<?php

namespace App\Dto\Api\V1\Comment;

use App\Dto\Api\V1\List\ListDto;
use App\Http\Requests\Api\V1\Comment\CommentListRequest;

class CommentListDto extends ListDto
{
    public ?int $user_id;
    public ?int $post_id;

    public static function fromRequest(CommentListRequest $request): self
    {
        return self::from([
            'perPage' => $request->getPerPage(),
            'page' => $request->getPage(),
            'q' => $request->getQ(),
            'user_id' => $request->getUserId(),
            'post_id' => $request->getPostId(),
        ]);
    }

}
