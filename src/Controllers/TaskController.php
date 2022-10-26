<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Services\TaskService\TaskService;
use App\Services\UserService\UserService;
use Laminas\Diactoros\Response;
use Psr\Http\Message\ServerRequestInterface;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

class TaskController extends Controller
{
    private TaskService $taskService;
    private UserService $userService;

    public function __construct(TaskService $taskService, UserService $userService)
    {
        parent::__construct();
        $this->taskService = $taskService;
        $this->userService = $userService;
    }

    /**
     * @throws SyntaxError
     * @throws RuntimeError
     * @throws LoaderError
     */
    public function index(): Response
    {
//        $user = $this->userService->getUserById($_SESSION['user_id']);
        return $this->html('task/index', 'Tasks');
    }

    /**
     * @throws SyntaxError
     * @throws RuntimeError
     * @throws LoaderError
     */
    public function create(): Response
    {
        return $this->html('task/create', 'Create new task');
    }

    public function store(): Response\JsonResponse
    {
        return $this->json(['he' => 'llo']);
    }

    public function update()
    {

    }

    public function edit(ServerRequestInterface $request)
    {

    }

    public function delete()
    {

    }
}