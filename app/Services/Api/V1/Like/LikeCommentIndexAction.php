<?php

namespace App\Services\Api\V1\Like;

use App\Dto\Api\V1\Like\IndexLikeCommentDto;
use App\Repository\Api\V1\Read\Like\LikeReadRepositoryInterface;

class LikeCommentIndexAction
{
    public function __construct(protected LikeReadRepositoryInterface $likeReadRepository) {}

    public function run(IndexLikeCommentDto $likeDto)
    {
        $data = $this->likeReadRepository->getByCommentId($likeDto->comment_id);

        return $data->load('user');
    }
}
