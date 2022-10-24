<?php
/**
 * @var $map Map
 */

use App\Controllers\HomeController;
use Aura\Router\Map;

/**
 * @var $container \App\Core\Container
 */

$map->get('home.index', '/', [HomeController::class, 'index']);
$map->get('user.signup-form', '/signup', [\App\Controllers\UserController::class, 'getSignupForm']);
$map->post('user.register', '/register', [\App\Controllers\UserController::class, 'register']);
$map->get('user.login-form', '/signin', [\App\Controllers\UserController::class, 'getLoginFrom']);
$map->post('user.login', '/login', [\App\Controllers\UserController::class, 'login']);