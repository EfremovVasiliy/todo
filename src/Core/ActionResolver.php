<?php

namespace App\Core;

use App\Exceptions\InvalidRouteException;
use Closure;

class ActionResolver
{
    /**
     * @throws \Exception
     */
    public function resolve($handler)
    {
        if ($handler instanceof Closure) {
            return $handler;
        }else if (is_string($handler)) {
            return new $handler();
        } else {
            throw new InvalidRouteException('Unknown route');
        }
    }
}