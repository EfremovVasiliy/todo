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
     * @param ServerRequestInterface $request
     * @return Response|void
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     * @throws \Exception
     */
    public function store(ServerRequestInterface $request)
    {
        $errors = $this->taskService->create($request);
        if (!empty($errors)) return $this->html('task/create', 'Create new task', ['errors' =>$errors]);
        header('Location: /');
    }

    /**
     * @throws SyntaxError
     * @throws RuntimeError
     * @throws LoaderError
     */
    public function update(ServerRequestInterface $request): Response
    {
        $id = $request->getAttribute('id');
        $task = $this->taskService->find($id);

        return $this->html('task/update', 'Update task', ['task' => $task]);
    }

    /**
     * @param ServerRequestInterface $request
     * @return Response|void
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     * @throws \Exception
     */
    public function edit(ServerRequestInterface $request)
    {
        $task = $this->taskService->find($request->getParsedBody()['task_id']);
        $errors = $this->taskService->edit($request);

        if (!empty($errors)) return $this->html('task/update', 'Update task', [
            'errors' => $errors,
            'task' => $task
        ]);
        header('Location: /');
    }

    /**
     * @param ServerRequestInterface $request
     * @return void
     */
    public function delete(ServerRequestInterface $request): void
    {
        $this->taskService->delete($request);
        header('Location: /');
    }
}