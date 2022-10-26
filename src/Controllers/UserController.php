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

    public function __construct(UserService $userService)
    {
        parent::__construct();
        $this->userService = $userService;
    }

    /**
     * @throws SyntaxError
     * @throws RuntimeError
     * @throws LoaderError
     */
    public function getSignupForm(): Response
    {
        if ($this->userService->checkAuth()) {
            header('Location: /');
        }
        return $this->html('user/signup', 'Signup');
    }

    /**
     * @throws SyntaxError
     * @throws RuntimeError
     * @throws LoaderError
     */
    public function getLoginFrom(): Response
    {
        if ($this->userService->checkAuth()) {
            header('Location: /');
        }
        return $this->html('user/login', 'Login');
    }

    /**
     * @throws OptimisticLockException
     * @throws ORMException
     */
    public function register(ServerRequestInterface $request): void
    {

        if (!$this->userService->checkAuth()) {
            $this->userService->register($request);
        }
        header('Location: /');
    }

    /**
     * @param ServerRequestInterface $request
     * @return void
     */
    public function login(ServerRequestInterface $request): void
    {
        if (!$this->userService->login($request)) {
            header('Location: /signin');
        }
        header('Location: /');
    }

    /**
     * @return void
     */
    public function logout(): void
    {
        unset($_SESSION['user_id']);
        unset($_SESSION['username']);
        header('Location: /signin');
    }
}