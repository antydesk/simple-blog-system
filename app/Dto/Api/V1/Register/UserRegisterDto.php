<?php

namespace App\Dto\Api\V1\Register;

use App\Http\Requests\Api\V1\Register\UserRegisterRequest;
use Spatie\LaravelData\Data;

class UserRegisterDto extends Data
{
    public string $name;
    public string $email;
    public string $password;

    public static function fromRequest(UserRegisterRequest $request): UserRegisterDto
    {
        return self::from([
            'name' => $request->getName(),
            'email' => $request->getEmail(),
            'password' => $request->getPassword(),
        ]);
    }
}
