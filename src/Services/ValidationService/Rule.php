<?php

namespace App\Services\ValidationService;

class Rule
{
    public function __construct(
        public string $object,
        public string $type,
        public int $maxLength = 0,
        public int $minLength = 0,
    ){}
}