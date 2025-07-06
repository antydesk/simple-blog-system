<?php

namespace App\Repository\Api\V1\Read\Like;

use Illuminate\Database\Eloquent\Collection;

interface LikeReadRepositoryInterface
{
    public function getByPostId(int $postId): Collection;

}
