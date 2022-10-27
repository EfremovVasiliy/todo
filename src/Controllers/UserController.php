<?php

namespace App\Controllers;

use App\Core\Auth;
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
        if (Auth::check()) {
            header('Location: /');
        }
        return $this->html('user/signup', 'Signup');
    }

    /**
     * @return Response
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     */
    public function getChangePasswordForm(): Response
    {
        return $this->html('user/change', 'Change password');
    }

    public function change(ServerRequestInterface $request)
    {
        $errors = $this->userService->changePassword($request);
        if (!empty($errors)) {
            return $this->html('user/change', 'Change password', ['errors' => $errors]);
        } else {
            header('Location: /');
        }
    }

    /**
     * @throws SyntaxError
     * @throws RuntimeError
     * @throws LoaderError
     */
    public function getLoginFrom(): Response
    {
        if (Auth::check()) {
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
        if (!Auth::check()) {
            $this->userService->register($request);
        }
        header('Location: /');
    }

    /**
     * @param ServerRequestInterface $request
     */
    public function login(ServerRequestInterface $request)
    {
        $errors = $this->userService->login($request);

        if (!empty($errors)) {
            return $this->html('user/login', 'Login', ['errors' => $errors]);
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