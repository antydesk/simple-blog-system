<?php

namespace App\Services\Api\V1\Auth\Actions;

use App\Dto\Api\V1\Auth\UserLoginDto;
use App\Models\User;
use App\Repository\Api\V1\Read\User\UserReadRepositoryInterface;
use App\Repository\Api\V1\Write\User\UserWriteRepositoryInterface;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Support\Facades\Config;
use Laravel\Passport\Client;
use Laravel\Passport\Exceptions\OAuthServerException;
use Laravel\Passport\Http\Controllers\HandlesOAuthErrors;
use League\OAuth2\Server\AuthorizationServer;
use Nyholm\Psr7\Factory\Psr17Factory;
use Nyholm\Psr7\Response as Psr7Response;
use Psr\Http\Message\ServerRequestInterface;
use Symfony\Bridge\PsrHttpMessage\Factory\PsrHttpFactory;

class ParentAuthAction
{
    use HandlesOAuthErrors;

    protected User $user;
    protected array $tokenData = [];
    protected ?Client $client = null; // ✅ исправлено: может быть null и не readonly
    protected UserLoginDto $dto;
    protected ServerRequestInterface $serverRequest;

    public function __construct(
        protected readonly AuthorizationServer $server,
        protected readonly UserReadRepositoryInterface $userReadRepository,
        protected readonly UserWriteRepositoryInterface $userWriteRepository,
    ) {
    }

    protected function createServerRequest(): void
    {
        $this->serverRequest = (new PsrHttpFactory(
            new Psr17Factory(),
            new Psr17Factory(),
            new Psr17Factory(),
            new Psr17Factory()
        ))->createRequest(request());
    }

    protected function getPassportCredentials(): void
    {
        $oClientId = Config::get('passport.personal_access_client.id');

        $this->client = Client::query()
            ->where('id', $oClientId)
            ->first();
    }

    /**
     * @throws AuthenticationException
     */
    protected function getClientCredentials(array $data): void
    {
        $oClientId = Config::get('passport.client_credentials_client.id');
        $secret = Config::get('passport.client_credentials_client.secret');

        if ($data['client_secret'] !== $secret || $data['client_id'] !== $oClientId) {
            throw new AuthenticationException();
        }

        $this->client = Client::query()
            ->where('id', $data['client_id'])
            ->first();
    }

    /**
     * @throws AuthenticationException
     */
    protected function withParsedBodyToServerRequest(): void
    {
        if ($this->client && $this->client->id && $this->client->secret) {
            $this->serverRequest = $this->serverRequest->withParsedBody([
                'grant_type'    => 'password',
                'username'      => $this->dto->email,
                'client_id'     => $this->client->id,
                'password'      => $this->dto->password,
                'client_secret' => $this->client->secret,
                'scope'         => '*',
            ]);
        } else {
            throw new AuthenticationException();
        }
    }

    /**
     * @throws AuthenticationException
     */
    protected function withParsedBodyToServerRequestForClientCredentials(): void
    {
        if ($this->client && $this->client->id && $this->client->secret) {
            $this->serverRequest = $this->serverRequest->withParsedBody([
                'grant_type'    => 'client_credentials',
                'client_id'     => $this->client->id,
                'client_secret' => $this->client->secret,
                'scope'         => 'report',
            ]);
        } else {
            throw new AuthenticationException();
        }
    }

    /**
     * @throws AuthenticationException
     */
    protected function withParsedBodyToServerRequestForRefreshToken(string $refreshToken): void
    {
        if ($this->client && $this->client->id && $this->client->secret) {
            $this->serverRequest = $this->serverRequest->withParsedBody([
                'grant_type'    => 'refresh_token',
                'client_id'     => $this->client->id,
                'client_secret' => $this->client->secret,
                'refresh_token' => $refreshToken,
                'scope'         => '*',
            ]);
        } else {
            throw new AuthenticationException();
        }
    }

    /**
     * @throws AuthorizationException
     * @throws OAuthServerException
     */
    protected function createAuthenticationToken(): void
    {
        $serverRequest = $this->serverRequest;

        $response = $this->withErrorHandling(function () use ($serverRequest) {
            return $this->convertResponse(
                $this->server->respondToAccessTokenRequest($serverRequest, new Psr7Response)
            );
        });

        $this->tokenData = json_decode($response->getContent(), true) ?? [];

        if (empty($this->tokenData)) {
            throw new AuthorizationException();
        }
    }
}
