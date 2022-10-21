<?php

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\ORMSetup;

require_once('vendor/autoload.php');

$isDevMode = true;
$proxyDir = null;
$cache = null;
$useSimpleAnnotationReader = false;
$config = ORMSetup::createAnnotationMetadataConfiguration(array(__DIR__.'/../src/Models'), $isDevMode, $proxyDir, $cache, $useSimpleAnnotationReader);

$connection = [
    'dbname' => 'todo',
    'user' => 'user',
    'password' => '111111',
    'host' => 'localhost',
    'driver' => 'pdo_mysql',
];

$entityManager = EntityManager::create($connection, $config);
