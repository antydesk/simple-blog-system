<?php

namespace App\Dto\Api\V1\Comment;

use App\Dto\Api\V1\List\ListDto;
use App\Http\Requests\Api\V1\Comment\CommentChildrenListRequest;
use App\Http\Requests\Api\V1\Comment\CommentListRequest;

class CommentChildrenListDto extends ListDto
{
    public string $user_id;
    public string $post_id;
    public string $parent_id;

    public static function fromRequest(CommentChildrenListRequest $request): self
    {
        return self::from([
            'perPage' => $request->getPerPage(),
            'page' => $request->getPage(),
            'q' => $request->getQ(),
            'user_id' => $request->getUserId(),
            'post_id' => $request->getPostId(),
            'parent_id' => $request->getParentId(),
        ]);
    }

}
