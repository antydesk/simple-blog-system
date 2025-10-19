<?php

namespace App\Services\Api\V1\Comment;

use App\Dto\Api\V1\Comment\CommentUpdateDto;
use App\Models\Comment;
use App\Repository\Api\V1\Write\Comment\CommentWriteRepositoryInterface;

class CommentUpdateAction
{
    public function __construct(protected CommentWriteRepositoryInterface $commentWriteRepository) {}

    public function run(CommentUpdateDto $commentUpdateDto): Comment
    {
        return $this->commentWriteRepository->update($commentUpdateDto);
    }
}
