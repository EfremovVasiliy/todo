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
$map->get('user.register', '/register', [\App\Controllers\UserController::class, 'register']);