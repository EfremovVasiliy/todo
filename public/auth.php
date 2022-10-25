<?php

use Jasny\Auth\Auth;
use Jasny\Auth\Authz\Levels;

$level = new Levels([
    'user' => 1,
    'admin' => 10,
    'root' => 100,
]);

$storage = '';

$auth = new Auth($level, $storage);