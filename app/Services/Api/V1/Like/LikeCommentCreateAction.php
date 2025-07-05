<?php

namespace App\Services\Api\V1\Like;

use App\Dto\Api\V1\Like\CreateLikeCommentDto;
use App\Dto\Api\V1\Like\CreateLikeDto;
use App\Models\Like;
use App\Repository\Api\V1\Write\Like\LikeWriteRepositoryInterface;

class LikeCommentCreateAction
{
    public function __construct(protected LikeWriteRepositoryInterface $likeWriteRepository)
    {
    }

    public function run(CreateLikeCommentDto $createLikeCommentDto): Like
    {
        $data = $this->likeWriteRepository->createByComment($createLikeCommentDto);

        return  $data->load('user','likeable');
    }

}
