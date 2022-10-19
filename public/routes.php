<?php
/**
 * @var $map Map
 */

use Aura\Router\Map;
use Laminas\Diactoros\Response;

$map->get('home.index', '/', [\App\Controllers\HomeController::class, 'index']);
$map->get('user.register', '/register', [\App\Controllers\UserController::class, 'register']);