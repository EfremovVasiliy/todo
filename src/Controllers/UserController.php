<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Services\UserService\UserService;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

class UserController extends Controller
{
    private UserService $userService;

    public function __construct(UserService $userService, ResponseInterface $response)
    {
        parent::__construct($response);
        $this->userService = $userService;
    }

    /**
     * @throws SyntaxError
     * @throws RuntimeError
     * @throws LoaderError
     */
    public function register(ServerRequestInterface $request): ResponseInterface
    {
        $string = $this->userService->register($request);
        return $this->render('user/register', ['string' => $string]);
    }
}