<?php

namespace App\Services\Api\V1\Post;

use App\Dto\Api\V1\Post\PostCreateDto;
use App\Models\Post;
use App\Repository\Api\V1\Write\Post\PostWriteRepositoryInterface;

class PostCreateAction
{
    public function __construct(protected PostWriteRepositoryInterface $postWriteRepository) {}

    public function run(PostCreateDto $postCreateDto): Post
    {
        $post = $this->postWriteRepository->create($postCreateDto);

        return $post->load('user');
    }
}
