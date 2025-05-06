<?php

namespace App\Http\Controllers\Api\V1\Login;

use App\Dto\Api\V1\Login\UserLoginDto;
use App\Http\Requests\Api\V1\Login\UserLoginRequest;
use App\Http\Resources\Api\V1\User\UserResource;
use App\Services\Api\V1\Login\UserLoginAction;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class UserLoginController
{

    /**
     * @throws AuthenticationException
     */
    public function login(UserLoginRequest $request, UserLoginAction $userLoginAction): JsonResponse
    {
        $dto = UserLoginDto::fromRequest($request);

        $data = $userLoginAction->run($dto);

        return response()->json([
            'user' => new UserResource($data['user']),
            'token' => $data['token'],
        ], Response::HTTP_OK);
    }
}
