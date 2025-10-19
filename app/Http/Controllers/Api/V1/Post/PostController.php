<?php

namespace App\Http\Controllers\Api\V1\Post;

use App\Dto\Api\V1\Post\PostCreateDto;
use App\Dto\Api\V1\Post\PostListDto;
use App\Dto\Api\V1\Post\PostUpdateDto;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\Post\PostCreateRequest;
use App\Http\Requests\Api\V1\Post\PostListRequest;
use App\Http\Requests\Api\V1\Post\PostUpdateRequest;
use App\Http\Resources\Api\V1\Post\PostResource;
use App\Services\Api\V1\Post\PostCreateAction;
use App\Services\Api\V1\Post\PostDestroyAction;
use App\Services\Api\V1\Post\PostIndexAction;
use App\Services\Api\V1\Post\PostShowAction;
use App\Services\Api\V1\Post\PostUpdateAction;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class PostController extends Controller
{
    public function create(PostCreateRequest $postCreateRequest, PostCreateAction $postCreateAction): PostResource
    {
        $dto = PostCreateDto::fromRequest($postCreateRequest);

        $post = $postCreateAction->run($dto);

        return new PostResource($post);
    }

    public function update(PostUpdateRequest $postUpdateRequest, PostUpdateAction $postUpdateAction): PostResource
    {
        $dto = PostUpdateDto::fromRequest($postUpdateRequest);

        $post = $postUpdateAction->run($dto);

        return new PostResource($post);
    }

    public function show(int $user_id, int $post_id, PostShowAction $postShowAction): PostResource
    {
        $post = $postShowAction->run($post_id);

        return new PostResource($post);
    }

    public function index(PostListRequest $postIndexRequest, PostIndexAction $postIndexAction): AnonymousResourceCollection
    {
        $dto = PostListDto::fromRequest($postIndexRequest);

        $posts = $postIndexAction->run($dto);

        return PostResource::collection($posts);
    }

    public function destroy(int $user_id, int $post_id, PostDestroyAction $postDestroyAction): JsonResponse
    {
        $postDestroyAction->run($post_id);

        return response()->json(['message' => 'Post deleted successfully'], ResponseAlias::HTTP_OK);
    }
}
