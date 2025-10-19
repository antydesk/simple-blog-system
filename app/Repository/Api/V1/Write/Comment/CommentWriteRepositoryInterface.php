<?php

namespace App\Repository\Api\V1\Write\Comment;

use App\Dto\Api\V1\Comment\CommentCreateDto;
use App\Dto\Api\V1\Comment\CommentUpdateDto;
use App\Models\Comment;

interface CommentWriteRepositoryInterface
{
    public function create(CommentCreateDto $commentCreateDto): Comment;

    public function update(CommentUpdateDto $commentUpdateDto): Comment;

    public function destroy(int $comment_id): bool;
}
