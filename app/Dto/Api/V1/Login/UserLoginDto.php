<?php

namespace App\Dto\Api\V1\Login;

use App\Http\Requests\Api\V1\Login\UserLoginRequest;
use Spatie\LaravelData\Data;

class UserLoginDto extends Data
{
    public string $email;
    public string $password;
//    public ?string $ip;
//    public ?bool $remember;

    public static function fromRequest(UserLoginRequest $request): UserLoginDto
    {
        return self::from([
            'email' => $request->getEmail(),
            'password' => $request->getPassword(),
//            'ip' => $request->getIp(),
//            'remember' => $request->has('remember') ? $request->getRemember() : false,
        ]);
    }

}
