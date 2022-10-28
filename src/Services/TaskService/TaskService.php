<?php

namespace App\Services\TaskService;

use App\Entities\Task;
use App\Entities\User;
use App\Services\ValidationService\Rule;
use App\Services\ValidationService\ValidationService;
use Doctrine\ORM\EntityManager;
use Psr\Http\Message\ServerRequestInterface;

class TaskService
{
    private EntityManager $entityManager;
    private ValidationService $validationService;

    public function __construct(EntityManager $entityManager, ValidationService $validationService)
    {
        $this->entityManager = $entityManager;
        $this->validationService = $validationService;
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
     * @param ServerRequestInterface $request
     * @return array|void
     * @throws \Exception
     */
    public function create(ServerRequestInterface $request)
    {
        $validationParams = [
            new Rule('title', FILTER_DEFAULT, 30),
            new Rule('description', FILTER_DEFAULT, 1000),
            new Rule('expires', FILTER_DEFAULT)
        ];

        $errors = $this->validationService->validate($request, $validationParams);

        if (!empty($errors)) return $errors;

        $title = $request->getParsedBody()['title'];
        $description = $request->getParsedBody()['description'];
        $expires = $request->getParsedBody()['expires'];
        $expires = new \DateTime($expires);
        $user = $this->entityManager->getRepository(User::class)->getOne($_SESSION['user_id']);

        $this->entityManager->getRepository(Task::class)->createTask($title, $description, $expires, $user);
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
     * @param ServerRequestInterface $request
     * @return array|void
     * @throws \Exception
     */
    public function edit(ServerRequestInterface $request)
    {
        $validationParams = [
            new Rule('title', FILTER_DEFAULT, 30),
            new Rule('description', FILTER_DEFAULT, 1000),
            new Rule('expires', FILTER_DEFAULT)
        ];

        $errors = $this->validationService->validate($request, $validationParams);

        if (!empty($errors)) return $errors;

        $id = $request->getParsedBody()['task_id'];
        $title = $request->getParsedBody()['title'];
        $description = $request->getParsedBody()['description'];
        $expires = $request->getParsedBody()['expires'];
        $expires = new \DateTime($expires);

        $this->entityManager->getRepository(Task::class)->editTask($id, $title, $description, $expires);
    }
}