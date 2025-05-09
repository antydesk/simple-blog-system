<?php

namespace App\Http\Requests\Api\V1\Auth;

use Illuminate\Foundation\Http\FormRequest;

class MeRequest extends FormRequest
{
    public function getUserId(): string
    {
        return $this->user()->id;
    }
}
