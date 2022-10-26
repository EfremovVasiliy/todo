<?php
/**
 * @var $map Map
 */

use Aura\Router\Map;

/**
 * @var $container \App\Core\Container
 */

$map->get('task.index', '/', [\App\Controllers\TaskController::class, 'index']);
$map->get('task.create', '/create', [\App\Controllers\TaskController::class, 'create']);
$map->post('task.store', '/store', [\App\Controllers\TaskController::class, 'store']);
$map->put('task.update', '/update', [\App\Controllers\TaskController::class, 'index']);
$map->delete('task.delete', '/delete', [\App\Controllers\TaskController::class, 'index']);
$map->get('user.signup-form', '/signup', [\App\Controllers\UserController::class, 'getSignupForm']);
$map->post('user.register', '/register', [\App\Controllers\UserController::class, 'register']);
$map->get('user.login-form', '/signin', [\App\Controllers\UserController::class, 'getLoginFrom']);
$map->post('user.login', '/login', [\App\Controllers\UserController::class, 'login']);
$map->post('user.logout', '/logout', [\App\Controllers\UserController::class, 'logout']);