<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Dto\Api\V1\Auth\UserLoginDto;
use App\Dto\Api\V1\Auth\UserRegisterDto;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\Auth\LoginRequest;
use App\Http\Requests\Api\V1\Auth\MeRequest;
use App\Http\Requests\Api\V1\Auth\RefreshTokenRequest;
use App\Http\Requests\Api\V1\Auth\RegisterRequest;
use App\Http\Resources\Api\V1\Auth\CredentialResource;
use App\Http\Resources\Api\V1\User\UserResource;
use App\Services\Api\V1\Auth\Actions\LoginAction;
use App\Services\Api\V1\Auth\Actions\LogOutAction;
use App\Services\Api\V1\Auth\Actions\MeAction;
use App\Services\Api\V1\Auth\Actions\RefreshTokenAction;
use App\Services\Api\V1\Auth\Actions\RegisterAction;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Laravel\Passport\Exceptions\OAuthServerException;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class AuthController extends Controller
{
//    public function __construct()
//    {
//        $this->middleware('auth:api', ['except' => ['login', 'register', 'refreshToken']]);
//    }

    /**
     * @throws AuthorizationException
     * @throws AuthenticationException
     * @throws OAuthServerException
     */
    public function login(
        LoginRequest $request,
        LoginAction $loginAction
    ): CredentialResource {
        $dto = UserLoginDto::fromRequest($request);
        $result = $loginAction->run($dto);

        return new CredentialResource($result);
    }

    /**
     * @throws AuthorizationException
     * @throws AuthenticationException
     * @throws OAuthServerException
     */
    public function register(
        RegisterRequest $request,
        RegisterAction $registerAction
    ): JsonResponse {
        $dto = UserRegisterDto::fromRequest($request);

        $data = $registerAction->run($dto);

        return new CredentialResource($data)
            ->response()
            ->setStatusCode(ResponseAlias::HTTP_CREATED);
    }

    /**
     * @param LogOutAction $logOutAction
     * @return JsonResponse
     */
    public function logout(LogOutAction $logOutAction): JsonResponse
    {
        $user = Auth::user();
        $logOutAction->run($user);

        return response()->json(status: ResponseAlias::HTTP_NO_CONTENT);
    }

    /**
     * @throws AuthorizationException
     * @throws OAuthServerException
     * @throws AuthenticationException
     */
    public function refreshToken(
        RefreshTokenRequest $request,
        RefreshTokenAction $refreshTokenAction
    ): CredentialResource {
        $result = $refreshTokenAction->run($request->getRefreshToken());

        return new CredentialResource($result);
    }

    public function me(
        MeRequest $meRequest,
        MeAction $meAction
    ): UserResource {
        $user_id = $meRequest->getUserId();

        return $meAction->run($user_id);
    }
}
