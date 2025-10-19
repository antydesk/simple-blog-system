<?php

namespace App\Services\Api\V1\Comment;

use App\Dto\Api\V1\Comment\CommentListDto;
use App\Repository\Api\V1\Read\Comment\CommentReadRepositoryInterface;
use Illuminate\Pagination\LengthAwarePaginator;

class CommentIndexAction
{
    public function __construct(protected CommentReadRepositoryInterface $commentReadRepository) {}

    public function run(CommentListDto $commentListDto): LengthAwarePaginator
    {
        return $this->commentReadRepository->paginate(
            userId: $commentListDto->user_id,
            postId: $commentListDto->post_id,
            perPage: $commentListDto->perPage,
            page: $commentListDto->page,
            q: $commentListDto->q,
        );
    }
}
