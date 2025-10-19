<?php

namespace App\Repository\Api\V1\Write\Like;

use App\Dto\Api\V1\Like\CreateLikeCommentDto;
use App\Dto\Api\V1\Like\CreateLikeDto;
use App\Models\Like;

interface LikeWriteRepositoryInterface
{
    public function createByPost(CreateLikeDto $data): Like;

    public function createByComment(CreateLikeCommentDto $data): Like;
}
