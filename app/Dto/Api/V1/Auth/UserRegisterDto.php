<?php

namespace App\Dto\Api\V1\Auth;

use App\Http\Requests\Api\V1\Auth\RegisterRequest;
use Spatie\LaravelData\Data;

class UserRegisterDto extends Data
{
    public string $name;
    public string $email;
    public string $password;

    public static function fromRequest(RegisterRequest $request): self
    {
        return self::from([
            'name' => $request->getName(),
            'email' => $request->getEmail(),
            'password' => $request->getPassword(),
        ]);
    }
}
