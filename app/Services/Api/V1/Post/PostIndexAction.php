<?php

namespace App\Services\Api\V1\Post;

use App\Dto\Api\V1\Post\PostListDto;
use App\Repository\Api\V1\Read\Post\PostReadRepositoryInterface;
use Illuminate\Pagination\LengthAwarePaginator;

class PostIndexAction
{
    public function __construct(protected PostReadRepositoryInterface $postReadRepository)
    {
    }

    public function run(PostListDto $postListDto): LengthAwarePaginator
    {
        return $this->postReadRepository->paginate(
            userId: $postListDto->user_id,
            perPage: $postListDto->perPage,
            page: $postListDto->page,
            q: $postListDto->q,
            relations: ['user','comments']
        );
    }
}
