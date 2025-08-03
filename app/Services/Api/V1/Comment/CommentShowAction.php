<?php

namespace App\Services\Api\V1\Comment;

use App\Dto\Api\V1\Comment\CommentShowDto;
use App\Models\Comment;
use App\Repository\Api\V1\Read\Comment\CommentReadRepositoryInterface;

class CommentShowAction
{
    public function __construct(protected CommentReadRepositoryInterface $commentReadRepository)
    {
    }

    public function run(CommentShowDto $commentShowDto): Comment
    {
        return $this->commentReadRepository->getById($commentShowDto->id, ['post', 'user','likes']);
    }
}
