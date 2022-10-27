<?php

namespace App\Services\TaskService\Interfaces;

use App\Entities\Task;
use App\Entities\User;
use DateTime;

interface TaskServiceRepositoryInterface
{
    public function getAll(): array;
    public function getOne(int $id): Task;
    public function createTask(string $title, string $description, DateTime $expires, User $user): void;
    public function deleteTask(int $taskId): void;
    public function editTask(int $id, string $title, string $description, DateTime $expires): void;
}