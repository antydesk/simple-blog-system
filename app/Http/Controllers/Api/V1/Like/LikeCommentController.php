<?php

namespace App\Http\Controllers\Api\V1\Like;

use App\Dto\Api\V1\Like\CreateLikeCommentDto;
use App\Dto\Api\V1\Like\IndexLikeCommentDto;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\Like\LikeCommentCreateRequest;
use App\Http\Requests\Api\V1\Like\LikeCommentIndexRequest;
use App\Http\Resources\Api\V1\Like\LikeResource;
use App\Services\Api\V1\Like\LikeCommentCreateAction;
use App\Services\Api\V1\Like\LikeCommentIndexAction;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class LikeCommentController extends Controller
{
    public function create(
        LikeCommentCreateRequest $likeCommentCreateRequest,
        LikeCommentCreateAction $likeCommentCreateAction
    ): LikeResource {
        $dto = CreateLikeCommentDto::fromRequest($likeCommentCreateRequest);

        $data = $likeCommentCreateAction->run($dto);

        return new LikeResource($data);
    }

    public function index(
        LikeCommentIndexRequest $likeIndexRequest,
        LikeCommentIndexAction $likeIndexAction
    ): AnonymousResourceCollection {
        $dto = IndexLikeCommentDto::fromRequest($likeIndexRequest);

        $data = $likeIndexAction->run($dto);

        return LikeResource::collection($data);
    }
}
