<?php

namespace App\Core;

class Auth
{
    public static function check(): bool
    {
        if (isset($_SESSION['user_id'])) return true;
        return false;
    }
}