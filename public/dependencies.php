<?php

use App\Core\Container;
use App\Core\DB;
use App\Repositories\UserDatabaseRepository;
use App\Services\UserService\Interfaces\UserServiceRepositoryInterface;
use App\Services\UserService\UserService;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

$container = new Container(new ContainerBuilder());

$container->getBuilder()->register(\Psr\Http\Message\ResponseInterface::class, \Laminas\Diactoros\Response::class);
$container->getBuilder()->register(UserServiceRepositoryInterface::class, UserDatabaseRepository::class);
$container->getBuilder()->register(UserService::class, UserService::class)->addArgument(DB::db());
$container->getBuilder()->register(DB::class, DB::class);