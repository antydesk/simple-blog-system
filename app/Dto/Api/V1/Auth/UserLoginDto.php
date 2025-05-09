<?php

namespace App\Dto\Api\V1\Auth;

use App\Http\Requests\Api\V1\Auth\AuthRequest;
use Spatie\LaravelData\Data;

class UserLoginDto extends Data
{
    public string $email;
    public string $password;
    public ?string $ip;
    public ?bool $remember;

    public static function fromRequest(AuthRequest $request): self
    {
        return self::from([
            'email' => $request->getUsername(),
            'password' => $request->getPassword(),
            'ip' => $request->getIp(),
            'remember' => $request->has('remember') ? $request->getRemember() : false,
        ]);
    }
}
