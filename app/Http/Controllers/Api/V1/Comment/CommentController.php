<?php

namespace App\Http\Controllers\Api\V1\Comment;

use App\Dto\Api\V1\Comment\CommentChildrenListDto;
use App\Dto\Api\V1\Comment\CommentCreateDto;
use App\Dto\Api\V1\Comment\CommentListDto;
use App\Dto\Api\V1\Comment\CommentShowDto;
use App\Dto\Api\V1\Comment\CommentUpdateDto;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\Comment\CommentCreateRequest;
use App\Http\Requests\Api\V1\Comment\CommentListRequest;
use App\Http\Requests\Api\V1\Comment\CommentChildrenListRequest;
use App\Http\Requests\Api\V1\Comment\CommentShowRequest;
use App\Http\Requests\Api\V1\Comment\CommentUpdateRequest;
use App\Http\Resources\Api\V1\Comment\CommentResource;
use App\Services\Api\V1\Comment\CommentChildrenIndexAction;
use App\Services\Api\V1\Comment\CommentCreateAction;
use App\Services\Api\V1\Comment\CommentDestroyAction;
use App\Services\Api\V1\Comment\CommentIndexAction;
use App\Services\Api\V1\Comment\CommentShowAction;
use App\Services\Api\V1\Comment\CommentUpdateAction;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class CommentController extends Controller
{
    public function create(CommentCreateRequest $request, CommentCreateAction $commentCreateAction): CommentResource
    {
        $commentCreateDto = CommentCreateDto::fromRequest($request);

        $comment = $commentCreateAction->run($commentCreateDto);

        return new CommentResource($comment);
    }

    public function update(CommentUpdateRequest $request, CommentUpdateAction $commentUpdateAction): CommentResource
    {
        $commentCreateDto = CommentUpdateDto::fromRequest($request);


        $comment = $commentUpdateAction->run($commentCreateDto);

        return new CommentResource($comment);
    }

    public function show(CommentShowRequest $commentShowRequest, CommentShowAction $commentDestroyAction): CommentResource
    {

        $commentShowDto = CommentShowDto::fromRequest($commentShowRequest);

        $comment = $commentDestroyAction->run($commentShowDto);

        return new CommentResource($comment);
    }

    public function index(CommentListRequest $commentIndexRequest, CommentIndexAction $commentIndexAction): AnonymousResourceCollection
    {
        $dto = CommentListDto::fromRequest($commentIndexRequest);

        $comments = $commentIndexAction->run($dto);

        return CommentResource::collection($comments);
    }

    public function destroy(int $comment_id, CommentDestroyAction $commentDestroyAction): JsonResponse
    {
        $commentDestroyAction->run($comment_id);

        return response()->json(['message' => 'Comment deleted successfully.'], ResponseAlias::HTTP_OK);
    }

    public function getChildren(CommentChildrenListRequest $commentRepliesListRequest,CommentChildrenIndexAction $commentChildrenIndexAction): AnonymousResourceCollection
    {
        $dto = CommentChildrenListDto::fromRequest($commentRepliesListRequest);

        $comments = $commentChildrenIndexAction->run($dto);

        return CommentResource::collection($comments);
    }
}
