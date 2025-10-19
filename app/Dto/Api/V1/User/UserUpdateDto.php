<?php

namespace App\Dto\Api\V1\User;

use App\Http\Requests\Api\V1\User\UserUpdateRequest;
use Spatie\LaravelData\Data;

class UserUpdateDto extends Data
{
    public string $name;

    public string $email;

    public int $id;

    public static function fromRequest(UserUpdateRequest $request): UserUpdateDto
    {
        return self::from([
            'name' => $request->getName(),
            'email' => $request->getEmail(),
            'id' => $request->getId(),
        ]);
    }
}
