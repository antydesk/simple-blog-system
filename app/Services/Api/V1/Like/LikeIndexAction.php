<?php

namespace App\Services\Api\V1\Like;

use App\Dto\Api\V1\Like\IndexLikeDto;
use App\Repository\Api\V1\Read\Like\LikeReadRepositoryInterface;

class LikeIndexAction
{
    public function __construct(protected LikeReadRepositoryInterface $likeReadRepository)
    {
    }

    public function run(IndexLikeDto $likeDto)
    {
        $data = $this->likeReadRepository->getByPostId($likeDto->post_id);

        return $data->load('user');
    }

}
