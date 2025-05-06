<?php

namespace App\Http\Controllers\Api\V1\User;

use App\Dto\Api\V1\User\UserUpdateDto;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\User\UserUpdateRequest;
use App\Http\Resources\Api\V1\User\UserResource;
use App\Services\Api\V1\User\UserDestroyAction;
use App\Services\Api\V1\User\UserShowAction;
use App\Services\Api\V1\User\UserUpdateAction;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class UserController extends Controller
{
    public function show(string $user_id, UserShowAction $userShowAction): UserResource
    {
        $user = $userShowAction->run($user_id);

        return new UserResource($user);
    }

    public function update(UserUpdateRequest $userUpdateRequest, UserUpdateAction $userUpdateAction): UserResource
    {
        $dto = UserUpdateDto::fromRequest($userUpdateRequest);

        $user = $userUpdateAction->run($dto);

        return new UserResource($user);
    }

    public function destroy(int $user_id, UserDestroyAction $userDestroyAction): JsonResponse
    {
        $userDestroyAction->run($user_id);

        return response()->json(['message' => 'User deleted successfully'], ResponseAlias::HTTP_OK);
    }
}
