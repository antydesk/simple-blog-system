<?php

namespace App\Services\Api\V1\Post;

use App\Repository\Api\V1\Write\Post\PostWriteRepositoryInterface;

class PostDestroyAction
{
    public function __construct(protected PostWriteRepositoryInterface $postWriteRepository) {}

    public function run(int $post_id): bool
    {
        return $this->postWriteRepository->destroy($post_id);
    }
}
