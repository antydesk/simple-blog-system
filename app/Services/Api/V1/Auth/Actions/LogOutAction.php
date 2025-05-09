<?php

namespace App\Services\Api\V1\Auth\Actions;

use App\Models\User;

class LogOutAction
{
    public function run(User $user): void
    {
        $token = $user->token();
        $token->revoke();
    }
}
