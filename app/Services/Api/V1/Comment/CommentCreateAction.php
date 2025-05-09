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
        $comment = $this->commentWriteRepository->create($commentCreateDto);

        $relations = ['post', 'user'];

        if($commentCreateDto->parent_id){
            $relations[] = 'parent';
        }

        return $comment->load($relations);
    }
}
