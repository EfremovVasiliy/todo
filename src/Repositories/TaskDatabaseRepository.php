<?php

namespace App\Repositories;

use App\Entities\Task;
use App\Entities\User;
use App\Services\TaskService\Interfaces\TaskServiceRepositoryInterface;
use DateTime;
use Doctrine\ORM\EntityRepository;

class TaskDatabaseRepository extends EntityRepository implements TaskServiceRepositoryInterface
{
    public function getAll(): array
    {
        return $this->_em->getRepository(Task::class)->findAll();
    }

    public function getOne(int $id): Task
    {
        return $this->_em->getRepository(Task::class)->find($id);
    }

    public function createTask(string $title, string $description, DateTime $expires, User $user): void
    {
        $task = new Task($title, $description, $expires, $user);

        $this->_em->persist($task);
        $this->_em->flush();
    }

    public function deleteTask(int $taskId): void
    {
        $task = $this->getOne($taskId);

        $this->_em->remove($task);
        $this->_em->flush();
    }

    public function editTask(int $id, string $title, string $description, DateTime $expires): void
    {
        $task = $this->_em->getRepository(Task::class)->getOne($id);

        $task->setTitle($title);
        $task->setDescription($description);
        $task->setExpires($expires);

        $this->_em->persist($task);
        $this->_em->flush();
    }
}