<?php

namespace App\Repository\Api\V1\Read\User;

interface UserReadRepositoryInterface
{
    public function getById(int $id, array $relations = []);
    public function getByEmail(string $email, array $relations = []);
}
