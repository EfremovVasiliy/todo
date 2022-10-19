<?php

namespace App\Repositories;

use App\Services\UserService\Interfaces\UserServiceRepositoryInterface;

class UserDatabaseRepository implements UserServiceRepositoryInterface
{
    public string $string = 'I\'m so tired';
}