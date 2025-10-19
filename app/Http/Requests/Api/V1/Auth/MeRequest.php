<?php

namespace App\Http\Requests\Api\V1\Auth;

use Illuminate\Foundation\Http\FormRequest;

class MeRequest extends FormRequest
{
    public function getUserId(): int
    {
        return $this->user()->id;
    }
}
