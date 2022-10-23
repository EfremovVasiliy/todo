<?php

namespace App\Services\UserService;

use App\Entities\Task;
use App\Entities\User;
use Doctrine\ORM\EntityManager;
use Psr\Http\Message\ServerRequestInterface;

class UserService
{
    private EntityManager $entityManager;

    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function register(ServerRequestInterface $request): User
    {
        return $this->entityManager->getRepository(User::class)->getOne(1);
    }
}