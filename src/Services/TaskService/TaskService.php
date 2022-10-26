<?php

namespace App\Services\TaskService;

use Doctrine\ORM\EntityManager;

class TaskService
{
    private EntityManager $entityManager;

    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function create()
    {

    }
}