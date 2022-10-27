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
        if (!isset($_SESSION['user_id'])) {
            header('Location: /signin');
        }
        $user = $this->userService->getUserById($_SESSION['user_id']);
        return $this->html('task/index', 'Tasks', ['tasks' => $user->getTasks()]);
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

    /**
     * @throws \Exception
     */
    public function store(ServerRequestInterface $request)
    {
        $task = $this->taskService->create($request);
        header('Location: /');
    }

    public function update(ServerRequestInterface $request)
    {

    }

    public function edit(ServerRequestInterface $request)
    {

    }

    public function delete(ServerRequestInterface $request)
    {
        $this->taskService->delete($request);
        header('Location: /');
    }
}