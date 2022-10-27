<?php

namespace App\Core;

class Auth
{
    public static function check(): bool
    {
        return (bool)$_SESSION;
    }
}