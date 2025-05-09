<?php

namespace App\Http\Requests\Api\V1\Auth;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    public const string NAME = 'name';
    public const string EMAIL = 'email';
    public const string PASSWORD = 'password';

    public function rules(): array
    {
        return [
            self::NAME => [
                'required',
                'string',
                'between:2,255',
            ],
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
            ]
        ];
    }

    public function getName(): string
    {
        return $this->get(self::NAME);
    }


    public function getEmail(): string
    {
        return $this->get(self::EMAIL);
    }

    public function getPassword(): string
    {
        return $this->get(self::PASSWORD);
    }

}
