<?php

namespace App\Http\Requests\Api\V1\Login;

use Illuminate\Foundation\Http\FormRequest;

class UserLoginRequest extends FormRequest
{
    public const string EMAIL = 'email';
    public const string PASSWORD = 'password';

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            self::EMAIL => [
                'required',
                'string',
                'email',
            ],
            self::PASSWORD => [
                'required',
                'confirmed',
                'string',
                'min:8',
            ]
        ];
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
