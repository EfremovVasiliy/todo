<?php

namespace App\Services\UserService;

use App\Entities\User;
use App\Services\ValidationService\Rule;
use App\Services\ValidationService\ValidationService;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Exception\ORMException;
use Doctrine\ORM\OptimisticLockException;
use Psr\Http\Message\ServerRequestInterface;

class UserService
{
    private EntityManager $entityManager;
    private int $hash = 1;
    private ValidationService $validationService;

    public function __construct(EntityManager $entityManager, ValidationService $validationService)
    {
        $this->entityManager = $entityManager;
        $this->validationService = $validationService;
    }

    /**
     * @throws OptimisticLockException
     * @throws ORMException
     */
    public function register(ServerRequestInterface $request)
    {
        $validationParams = [
            new Rule('email', 40),
            new Rule('password', 30, 5)
        ];

        $errors = $this->validationService->validate($request, $validationParams);
        if (!empty($errors)) {
            return $errors;
        }
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
     */
    public function login(ServerRequestInterface $request)
    {
        $validationParams = [
            new Rule('email', 40),
            new Rule('password', 30, 5)
        ];

        $errors = $this->validationService->validate($request, $validationParams);

        $email = $request->getParsedBody()['email'];
        $password = $request->getParsedBody()['password'];

        if ($this->auth($email, $password)) $errors[] = 'Incorrect password';

        if (!empty($errors)) {
            return $errors;
        }
    }

    private function auth(string $email, string $password): bool
    {
        $user = $this->entityManager->getRepository(User::class)->getUserByEmail($email);

        if ($user->getPasswordHash() === md5($password)) {
            $_SESSION['user_id'] = $user->getId();
            $_SESSION['username'] = $user->getUsername();
        }
        return false;
    }

    /**
     * @param ServerRequestInterface $request
     * @return array
     */
    public function changePassword(ServerRequestInterface $request): array
    {
        $validationParams = [
            new Rule('current_password', 30, 5),
            new Rule('new_password', 30, 5)
        ];

        $errors = $this->validationService->validate($request, $validationParams);
        if (!empty($errors)) {
            return $errors;
        }

        $current = $request->getParsedBody()['current_password'];
        $new = $request->getParsedBody()['new_password'];

        $userId = $_SESSION['user_id'];

        return $this->entityManager->getRepository(User::class)->changePassword($current, $new, $userId);
    }

    public function getUserById(int $id): User
    {
        return $this->entityManager->getRepository(User::class)->getOne($id);
    }
}