<?php

namespace App\Services\TaskService\Interfaces;

use App\Entities\Task;

interface TaskServiceRepositoryInterface
{
    public function getAll(): array;
    public function getOne(int $id): Task;
}