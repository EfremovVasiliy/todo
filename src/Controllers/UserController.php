<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Services\UserService\UserService;
use Doctrine\ORM\Exception\ORMException;
use Doctrine\ORM\OptimisticLockException;
use Laminas\Diactoros\Response;
use Psr\Http\Message\ServerRequestInterface;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

class UserController extends Controller
{
    private UserService $userService;

    public function __construct(UserService $userService, Response $response)
    {
        parent::__construct($response);
        $this->userService = $userService;
    }

    /**
     * @throws SyntaxError
     * @throws RuntimeError
     * @throws LoaderError
     */
    public function getSignupForm(): Response
    {
        return $this->render('user/signup');
    }

    /**
     * @throws SyntaxError
     * @throws RuntimeError
     * @throws LoaderError
     */
    public function getLoginFrom(): Response
    {
        return $this->render('user/login');
    }

    /**
     * @throws OptimisticLockException
     * @throws ORMException
     */
    public function register(ServerRequestInterface $request): void
    {
        $user = $this->userService->register($request);

        header('Location: /');
    }

    /**
     * @param ServerRequestInterface $request
     * @return void
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function login(ServerRequestInterface $request): void
    {
        $user = $this->userService->register($request);

        header('Location: /');
    }
}