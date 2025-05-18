<?php

namespace App\Services\Api\V1\Comment;

use App\Repository\Api\V1\Read\Comment\CommentReadRepositoryInterface;
use App\Repository\Api\V1\Write\Comment\CommentWriteRepositoryInterface;

class CommentDestroyAction
{
    public function __construct(protected CommentWriteRepositoryInterface $commentWriteRepository)
    {
    }

    public function run(int $comment_id): bool
    {
        return $this->commentWriteRepository->destroy($comment_id);
    }
}
