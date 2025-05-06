<?php

namespace App\Http\Requests\Api\V1\Register;

use Illuminate\Foundation\Http\FormRequest;

class UserRegisterRequest extends FormRequest
{

    public const string NAME = 'name';
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
            self::NAME => [
                'required',
                'string',
                'min:3',
            ],
            self::EMAIL => [
                'required',
                'string',
                'email',
                'unique:users,email',
            ],
            self::PASSWORD => [
                'required',
                'confirmed',
                'string',
                'min:8',
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
