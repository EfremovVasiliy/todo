<?php

namespace App\Services\ValidationService;

class Rule
{
    public function __construct(
        public string $object,
        public ?int $maxLength = null,
        public ?int $minLength = null,
    ){}
}