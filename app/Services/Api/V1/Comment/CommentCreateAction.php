<?php

namespace App\Services\Api\V1\Comment;

use App\Dto\Api\V1\Comment\CommentCreateDto;
use App\Models\Comment;
use App\Repository\Api\V1\Write\Comment\CommentWriteRepositoryInterface;

class CommentCreateAction
{
    public function __construct(protected CommentWriteRepositoryInterface $commentWriteRepository)
    {
    }

    public function run(CommentCreateDto $commentCreateDto): Comment
    {
        return $this->commentWriteRepository->create($commentCreateDto);
    }
}
