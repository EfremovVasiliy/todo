<?php
/**
 * @var $map Map
 */

use App\Controllers\TaskController;
use App\Controllers\UserController;
use App\Core\Container;
use Aura\Router\Map;

/**
 * @var $container Container
 */

$map->get('task.index', '/', [TaskController::class, 'index'])->auth(true);
$map->get('task.create', '/create', [TaskController::class, 'create'])->auth(true);
$map->post('task.store', '/store', [TaskController::class, 'store'])->auth(true);
$map->post('task.edit', '/edit', [TaskController::class, 'edit'])->auth(true);
$map->get('task.update', '/update/{id}', [TaskController::class, 'update'])->tokens(['id' => '\d+'])->auth(true);
$map->post('task.delete', '/delete', [TaskController::class, 'delete'])->auth(true);
$map->get('user.signup-form', '/signup', [UserController::class, 'getSignupForm']);
$map->post('user.register', '/register', [UserController::class, 'register']);
$map->get('user.login-form', '/signin', [UserController::class, 'getLoginFrom']);
$map->post('user.login', '/login', [UserController::class, 'login']);
$map->get('user.change-from', '/change', [UserController::class, 'getChangePasswordForm'])->auth(true);
$map->post('user.change', '/change-pass', [UserController::class, 'change'])->auth(true);
$map->post('user.logout', '/logout', [UserController::class, 'logout'])->auth(true);
