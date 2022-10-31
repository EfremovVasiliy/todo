<?php

namespace App\Core;

use Doctrine\ORM\Configuration;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Exception\ORMException;
use Doctrine\ORM\ORMSetup;
use Psr\Cache\CacheItemPoolInterface;
use Symfony\Component\Yaml\Yaml;

class DB
{
    private static bool $isDevMode = true;
    private static ?string $proxyDir = null;
    private static CacheItemPoolInterface|null $cache = null;
    private static bool $useSimpleAnnotationReader = false;
    private static Configuration $config;

    /**
     * @throws ORMException
     */
    public static function db(): EntityManager
    {
        $params = self::getParams();

        $connection = [
            'dbname' => $params['db']['dbname'],
            'user' => $params['db']['username'],
            'password' => $params['db']['password'],
            'host' => $params['db']['host'],
            'driver' => $params['db']['driver'],
        ];

        self::$config = ORMSetup::createAnnotationMetadataConfiguration(
            [__DIR__ . '/../../src/Entities'],
            self::$isDevMode,
            self::$proxyDir,
            self::$cache,
            self::$useSimpleAnnotationReader
        );
        return EntityManager::create($connection, self::$config);
    }

    private static function getParams()
    {
        return Yaml::parseFile(__DIR__. '/../../config/config.yaml');
    }
}