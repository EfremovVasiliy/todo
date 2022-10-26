<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Services\TaskService\TaskService;
use App\Services\UserService\UserService;
use Laminas\Diactoros\Response;

class TaskController extends Controller
{
    private TaskService $taskService;
    private UserService $userService;

    public function __construct(TaskService $taskService, UserService $userService, Response $response)
    {
        parent::__construct($response);
        $this->taskService = $taskService;
        $this->userService = $userService;
    }

    public function index(): Response
    {
        $user = $this->userService->getUserById($_SESSION['user_id']);
        return $this->render('task/index', 'Tasks', ['tasks' => $user->getTasks()]);
    }

    public function create(): Response
    {
        return $this->render('task/create', 'Create new task');
    }
}