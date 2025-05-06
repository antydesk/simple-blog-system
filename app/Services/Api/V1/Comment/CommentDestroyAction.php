<?php

namespace App\Services\Api\V1\Comment;

use App\Repository\Api\V1\Read\Comment\CommentReadRepositoryInterface;

class CommentDestroyAction
{
    public function __construct(protected CommentReadRepositoryInterface $commentReadRepository)
    {
    }

    public function run(int $comment_id): bool
    {
        return $this->commentReadRepository->getById($comment_id);
    }
}
