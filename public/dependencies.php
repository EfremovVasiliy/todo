<?php

use App\Core\Container;
use App\Core\DB;
use App\Repositories\UserDatabaseRepository;
use App\Services\TaskService\TaskService;
use App\Services\UserService\Interfaces\UserServiceRepositoryInterface;
use App\Services\UserService\UserService;
use App\Services\ValidationService\ValidationService;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

$container = new Container(new ContainerBuilder());

$container->getBuilder()->register(UserServiceRepositoryInterface::class, UserDatabaseRepository::class);
$container->getBuilder()->register(UserService::class, UserService::class)
    ->addArgument(DB::db())
    ->addArgument(new Reference(ValidationService::class));
$container->getBuilder()->register(TaskService::class, TaskService::class)
    ->addArgument(DB::db())
    ->addArgument(new Reference(ValidationService::class));
$container->getBuilder()->register(ValidationService::class, ValidationService::class);
$container->getBuilder()->register(DB::class, DB::class);