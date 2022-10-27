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

    public function getUserByEmail(string $email)
    {
        $qb = $this->_em->createQueryBuilder();
        $query = $qb->select('user')
            ->from(User::class, 'user')
            ->where('user.email = :email')
            ->setParameter(':email', $email);

        $result = $query->getQuery();
        return $result->getResult()[0];
    }

    public function changePassword(string $currentPassword, string $newPassword, int $userId): array
    {
        $user = $this->_em->getRepository(User::class)->getOne($userId);
        $errors = [];
        if ($user->getPasswordHash() !== md5($currentPassword)) {
            $errors[] = 'Incorrect current password';
            return $errors;
        } else {
            $user->setPasswordHash($newPassword);
            $this->_em->persist($user);
            $this->_em->flush();
        }
        return $errors;
    }
}