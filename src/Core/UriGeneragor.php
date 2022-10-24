<?php

namespace App\Core;

use Aura\Router\Generator;

class UriGeneragor
{
    private Generator $generator;

    public function __construct(Generator $generator)
    {
        $this->generator = $generator;
    }

    public function getGenerator(): Generator
    {
        return $this->generator;
    }
}