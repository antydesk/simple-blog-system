<?php

namespace App\Repository\Api\V1\Write\Post;

use App\Dto\Api\V1\Post\PostCreateDto;
use App\Dto\Api\V1\Post\PostUpdateDto;
use App\Models\Post;

interface PostWriteRepositoryInterface
{
    public function create(PostCreateDto $postCreateDto): Post;

    public function update(PostUpdateDto $postUpdateDto): Post;

    public function destroy(int $post_id): bool;
}
