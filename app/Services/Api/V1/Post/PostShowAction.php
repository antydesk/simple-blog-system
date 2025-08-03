<?php

namespace App\Services\Api\V1\Post;

use App\Models\Post;
use App\Repository\Api\V1\Read\Post\PostReadRepositoryInterface;

class PostShowAction
{
    public function __construct(protected PostReadRepositoryInterface $postReadRepository)
    {
    }

    public function run(string $post_id): Post
    {
        return $this->postReadRepository->getById($post_id,['user','comments','likes']);
    }
}
