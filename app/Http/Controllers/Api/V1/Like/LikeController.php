<?php

namespace App\Http\Controllers\Api\V1\Like;

use App\Dto\Api\V1\Like\CreateLikeDto;
use App\Dto\Api\V1\Like\IndexLikeDto;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\Like\LikeCreateRequest;
use App\Http\Requests\Api\V1\Like\LikeIndexRequest;
use App\Http\Resources\Api\V1\Like\LikeResource;
use App\Services\Api\V1\Like\LikeCreateAction;
use App\Services\Api\V1\Like\LikeIndexAction;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class LikeController extends Controller
{
    public function create(LikeCreateRequest $likeCreateRequest, LikeCreateAction $likeCreateAction): LikeResource
    {
        $dto = CreateLikeDto::fromRequest($likeCreateRequest);

        $data = $likeCreateAction->run($dto);

        return new LikeResource($data);
    }

    public function index(
        LikeIndexRequest $likeIndexRequest,
        LikeIndexAction $likeIndexAction
    ): AnonymousResourceCollection {
        $dto = IndexLikeDto::fromRequest($likeIndexRequest);

        $data = $likeIndexAction->run($dto);

        return LikeResource::collection($data);
    }
}
