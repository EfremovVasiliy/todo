<?php

namespace App\Services\TaskService;

use App\Entities\Task;
use App\Entities\User;
use Doctrine\ORM\EntityManager;
use Psr\Http\Message\ServerRequestInterface;

class TaskService
{
    private EntityManager $entityManager;

    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @throws \Exception
     */
    public function create(ServerRequestInterface $request): Task
    {
        $title = $request->getParsedBody()['title'];
        $description = $request->getParsedBody()['description'];
        $expires = $request->getParsedBody()['expires'];
        $expires = new \DateTime($expires);
        $user = $this->entityManager->getRepository(User::class)->getOne($_SESSION['user_id']);

        return $this->entityManager->getRepository(Task::class)->createTask($title, $description, $expires, $user);
    }

    public function delete(ServerRequestInterface $request)
    {
        $this->entityManager->getRepository(Task::class)->deleteTask($request->getParsedBody()['task_id']);
    }
}