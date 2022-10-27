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
     * @param int $id
     * @return Task
     */
    public function find(int $id): Task
    {
        return $this->entityManager->getRepository(Task::class)->getOne($id);
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

    /**
     * @param ServerRequestInterface $request
     * @return void
     */
    public function delete(ServerRequestInterface $request): void
    {
        $this->entityManager->getRepository(Task::class)->deleteTask($request->getParsedBody()['task_id']);
    }

    /**
     * @throws \Exception
     */
    public function edit(ServerRequestInterface $request): void
    {
        $id = $request->getParsedBody()['task_id'];
        $title = $request->getParsedBody()['title'];
        $description = $request->getParsedBody()['description'];
        $expires = $request->getParsedBody()['expires'];
        $expires = new \DateTime($expires);
        $user = $this->entityManager->getRepository(User::class)->getOne($_SESSION['user_id']);

        $this->entityManager->getRepository(Task::class)->editTask($id, $title, $description, $expires);
    }
}