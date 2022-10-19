<?php

namespace App\Core;

use App\Exceptions\InvalidRouteException;
use JetBrains\PhpStorm\NoReturn;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

class Container
{
    private ContainerBuilder $builder;

    public function __construct(ContainerBuilder $builder)
    {
        $this->builder = $builder;
    }

    /**
     * @return ContainerBuilder
     */
    public function getBuilder(): ContainerBuilder
    {
        return $this->builder;
    }

    /**
     * @throws InvalidRouteException
     * @throws \Exception
     */
    public function get(array $handler): ?object
    {
        $controller = array_shift($handler);
        $action = array_shift($handler);

        if (!class_exists($controller)) throw new InvalidRouteException('Unknown controller '. $controller);
        if (!method_exists($controller, $action)) throw new InvalidRouteException('Unknown action '. $action);

        $this->setControllerDependencies($controller);

        return $this->builder->get($controller);
    }

    /**
     * @throws \ReflectionException
     */
    private function setControllerDependencies(string $controller): void
    {
        $references = [];
        $params = $this->builder->getReflectionClass($controller)->getMethod('__construct')->getParameters();

        foreach ($params as $param) {
            if ($this->builder->has($param->getType())) {
                $references[] = new Reference($param->getType());
            }
        }

        $this->builder->register($controller, $controller)->setArguments($references);
    }
}