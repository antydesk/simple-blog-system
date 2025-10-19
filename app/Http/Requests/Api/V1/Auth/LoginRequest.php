<?php

namespace App\Http\Requests\Api\V1\Auth;

class LoginRequest extends AuthRequest
{
    public const string REMEMBER = 'remember';

    public function rules(): array
    {
        return [
            self::REMEMBER => [
                'boolean',
                'nullable',
            ],
        ];
    }

    public function getRemember(): bool
    {
        return $this->get(self::REMEMBER);
    }
}
