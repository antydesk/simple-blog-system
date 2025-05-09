<?php

namespace App\Http\Requests\Api\V1\Auth;

use Illuminate\Foundation\Http\FormRequest;

class RefreshTokenRequest extends FormRequest
{
    const string REFRESH_TOKEN = 'refresh_token';

    public function rules(): array
    {
        return [
            self::REFRESH_TOKEN => [
                'string',
                'required',
            ]
        ];
    }

    public function getRefreshToken(): string
    {
        return $this->get(self::REFRESH_TOKEN);
    }
}
