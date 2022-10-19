<?php

namespace App\Services\UserService;

use App\Services\UserService\Interfaces\UserServiceRepositoryInterface;
use Psr\Http\Message\ServerRequestInterface;

class UserService
{
    private UserServiceRepositoryInterface $repository;

    public function __construct(UserServiceRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function register(ServerRequestInterface $request)
    {
        return $this->repository->string;
    }
}