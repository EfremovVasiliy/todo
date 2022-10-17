<?php

namespace App\Core;

use Closure;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

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
            throw new \Exception('Unknown route');
        }
    }
}