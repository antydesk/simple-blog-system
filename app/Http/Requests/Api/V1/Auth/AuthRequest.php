<?php

namespace App\Http\Requests\Api\V1\Auth;

use Illuminate\Foundation\Http\FormRequest;

class AuthRequest extends FormRequest
{
    public const string EMAIL = 'email';

    public const string PASSWORD = 'password';

    public function rules(): array
    {
        return [
            self::EMAIL => [
                'required',
                'string',
                'email',
                'unique:users',
            ],
            self::PASSWORD => [
                'required',
                'string',
                'between:5,255',
            ],
        ];
    }

    public function getUsername(): string
    {
        return $this->get(self::EMAIL);
    }

    public function getPassword(): string
    {
        return $this->get(self::PASSWORD);
    }

    public function getIp(): ?string
    {
        return $this->header('X-Forwarded-For');
    }
}
