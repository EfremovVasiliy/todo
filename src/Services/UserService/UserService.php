<?php

namespace App\Services\UserService;

use App\Entities\Task;
use Doctrine\ORM\EntityManager;
use Psr\Http\Message\ServerRequestInterface;

class UserService
{
    private EntityManager $entityManager;

    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function register(ServerRequestInterface $request)
    {
        return $this->entityManager->getRepository(Task::class)->getOne(1);
    }
}