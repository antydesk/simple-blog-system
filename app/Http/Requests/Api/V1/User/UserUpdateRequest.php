<?php

namespace App\Http\Requests\Api\V1\User;

use Illuminate\Foundation\Http\FormRequest;

class UserUpdateRequest extends FormRequest
{

    public const string NAME = 'name';
    public const string EMAIL = 'email';

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

    public function getId(): int
    {
        return  (int)$this->route('user_id');

    }

}
