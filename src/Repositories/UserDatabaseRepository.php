<?php

namespace App\Repositories;

use App\Entities\User;
use App\Services\UserService\Interfaces\UserServiceRepositoryInterface;
use Doctrine\ORM\EntityRepository;

class UserDatabaseRepository extends EntityRepository implements UserServiceRepositoryInterface
{
    public function getAll(): array
    {
        return $this->_em->getRepository(User::class)->findAll();
    }

    public function getOne(int $id): User
    {
        return $this->_em->getRepository(User::class)->find($id);
    }
}