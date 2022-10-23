<?php

namespace App\Services\UserService\Interfaces;

use App\Entities\User;

interface UserServiceRepositoryInterface
{
    public function getAll(): array;
    public function getOne(int $id): User;
}