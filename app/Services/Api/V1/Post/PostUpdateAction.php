<?php

namespace App\Services\Api\V1\Post;

use App\Dto\Api\V1\Post\PostCreateDto;
use App\Dto\Api\V1\Post\PostUpdateDto;
use App\Models\Post;
use App\Repository\Api\V1\Write\Post\PostWriteRepositoryInterface;

class PostUpdateAction
{
    public function __construct(protected PostWriteRepositoryInterface $postWriteRepository)
    {
    }

    public function run(PostUpdateDto $postUpdateDto): Post
    {
        return $this->postWriteRepository->update($postUpdateDto);
    }
}
