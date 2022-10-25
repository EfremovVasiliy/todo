<?php

namespace App\Services\UserService;

use App\Entities\User;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Exception\ORMException;
use Doctrine\ORM\OptimisticLockException;
use Psr\Http\Message\ServerRequestInterface;

class UserService
{
    private EntityManager $entityManager;

    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @throws OptimisticLockException
     * @throws ORMException
     */
    public function register(ServerRequestInterface $request): User
    {
        $nickname = $request->getParsedBody()['email'];
        $email = $request->getParsedBody()['email'];
        $password = $request->getParsedBody()['password'];

        $user = new User($nickname, $email, $password);

        $this->entityManager->persist($user);
        $this->entityManager->flush();

        return $user;
    }

    /**
     * @param ServerRequestInterface $request
     * @return User|false
     */
    public function login(ServerRequestInterface $request): User|false
    {
        $email = $request->getParsedBody()['email'];
        $password = $request->getParsedBody()['password'];
        $user = $this->entityManager->getRepository(User::class)->getUserByEmail($email);

        if ($user->getPasswordHash() !== password_hash($password, 1)) {
            return false;
        }

        return $user;
    }
}