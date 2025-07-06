<?php

namespace App\Services\Api\V1\Like;

use App\Dto\Api\V1\Like\CreateLikeDto;
use App\Models\Like;
use App\Repository\Api\V1\Write\Like\LikeWriteRepositoryInterface;

class LikeCreateAction
{
    public function __construct(protected LikeWriteRepositoryInterface $likeWriteRepository)
    {
    }

    public function run(CreateLikeDto $createLikeDto): Like
    {
        $data = $this->likeWriteRepository->createByPost($createLikeDto);

        return  $data->load('user','likeable');
    }

}
