<?php

namespace App\Core;

use Doctrine\ORM\Configuration;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Exception\ORMException;
use Doctrine\ORM\ORMSetup;
use Psr\Cache\CacheItemPoolInterface;

class DB
{
    private static bool $isDevMode = true;
    private static ?string $proxyDir = null;
    private static CacheItemPoolInterface|null $cache = null;
    private static bool $useSimpleAnnotationReader = false;
    private static Configuration $config;

    private static array $connection = [
        'dbname' => 'todo',
        'user' => 'user',
        'password' => '111111',
        'host' => 'localhost',
        'driver' => 'pdo_mysql',
    ];

    /**
     * @throws ORMException
     */
    public static function db(): EntityManager
    {
        self::$config = ORMSetup::createAnnotationMetadataConfiguration(
            [__DIR__ . '/../../src/Entities'],
            self::$isDevMode,
            self::$proxyDir,
            self::$cache,
            self::$useSimpleAnnotationReader
        );
        return EntityManager::create(self::$connection, self::$config);
    }
}