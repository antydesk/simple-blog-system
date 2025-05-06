<?php

namespace App\Http\Controllers\Api\V1\Register;

use App\Dto\Api\V1\Register\UserRegisterDto;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\Register\UserRegisterRequest;
use App\Http\Resources\Api\V1\User\UserResource;
use App\Services\Api\V1\Register\UserRegisterAction;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class UserRegisterController extends Controller
{
    public function register(UserRegisterRequest $request, UserRegisterAction $userRegisterAction): JsonResponse
    {
        $dto = UserRegisterDto::fromRequest($request);

        $data = $userRegisterAction->run($dto);

        return response()->json([
            'user' => new UserResource($data['user']),
            'token' => $data['token'],
        ], Response::HTTP_CREATED);
    }
}
