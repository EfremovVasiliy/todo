<?php

use App\Core\Container;
use App\Repositories\UserDatabaseRepository;
use App\Services\UserService\Interfaces\UserServiceRepositoryInterface;
use App\Services\UserService\UserService;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

$container = new Container(new ContainerBuilder());

$container->getBuilder()->register(\Laminas\Diactoros\Response::class, \Laminas\Diactoros\Response::class);
$container->getBuilder()->register(UserServiceRepositoryInterface::class, UserDatabaseRepository::class);
$container->getBuilder()->register(UserService::class, UserService::class)->addArgument(new Reference(UserServiceRepositoryInterface::class));