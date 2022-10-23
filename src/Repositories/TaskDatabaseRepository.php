<?php

namespace App\Repositories;

use App\Entities\Task;
use Doctrine\ORM\EntityRepository;

class TaskDatabaseRepository extends EntityRepository
{
    public function getAll(): array
    {
        return $this->_em->getRepository(Task::class)->findAll();
    }

    public function getOne(int $id): Task
    {
        return $this->_em->getRepository(Task::class)->find($id);
    }
}