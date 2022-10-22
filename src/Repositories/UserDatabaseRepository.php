<?php

namespace App\Repositories;

use App\Services\UserService\Interfaces\UserServiceRepositoryInterface;
use Doctrine\ORM\EntityRepository;

class UserDatabaseRepository extends EntityRepository implements UserServiceRepositoryInterface
{
    public function getAll()
    {
        return $this->_em->createQuery('SELECT task FROM App\Entities\Task task')->getResult();
    }

    public function getOne(int $id)
    {
        return $this->_em->
        createQuery('SELECT task FROM App\Entities\Task task WHERE task.id = :id')
            ->setParameter(':id', $id)->getResult();
    }
}