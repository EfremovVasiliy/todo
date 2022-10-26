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
    private int $hash = 1;

    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;

    }

    /**
     * @throws OptimisticLockException
     * @throws ORMException
     */
    public function register(ServerRequestInterface $request): void
    {
        $username = $request->getParsedBody()['username'];
        $email = $request->getParsedBody()['email'];
        $password = $request->getParsedBody()['password'];

        $user = new User($username, $email, $password, $this->hash);

        $this->entityManager->persist($user);
        $this->entityManager->flush();

        $this->auth($email, $password);
    }

    /**
     * @param ServerRequestInterface $request
     * @return bool
     */
    public function login(ServerRequestInterface $request): bool
    {
        $email = $request->getParsedBody()['email'];
        $password = $request->getParsedBody()['password'];

       return $this->auth($email, $password);
    }

    private function auth(string $email, string $password): bool
    {
        $user = $this->entityManager->getRepository(User::class)->getUserByEmail($email);

        if ($user->getPasswordHash() === md5($password)) {
            $_SESSION['user_id'] = $user->getId();
            $_SESSION['username'] = $user->getUsername();
            return true;
        }
        return false;
    }

    public function checkAuth(): bool
    {
        if (isset($_SESSION['user_id'])) {
            return true;
        }

        return false;
    }

    public function getUserById(int $id): User
    {
        return $this->entityManager->getRepository(User::class)->getOne($id);
    }
}