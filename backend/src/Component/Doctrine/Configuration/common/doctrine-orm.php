<?php

declare(strict_types=1);

use Doctrine\Common\EventManager;
use Doctrine\DBAL\Connection;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Mapping\UnderscoreNamingStrategy;
use Doctrine\ORM\ORMSetup;
use Psr\Container\ContainerInterface;
use Symfony\Component\Cache\Adapter\ArrayAdapter;
use Symfony\Component\Cache\Adapter\FilesystemAdapter;

use function LaService\Component\Configuration\environment;

return [
    EntityManagerInterface::class => static function (): EntityManagerInterface {
        $config = ORMSetup::createAttributeMetadataConfiguration(
            [],
            (bool)environment('APPLICATION_ENVIRONMENT', 'production'),
            __DIR__ . '/../../../../../var/cache/' . PHP_SAPI . 'doctrine/proxy',
            (__DIR__ . '/../../../../../var/cache/' . PHP_SAPI . 'doctrine/cache') ? new FilesystemAdapter('', 0, __DIR__ . '/../../../../../var/cache/' . PHP_SAPI . 'doctrine/cache') : new ArrayAdapter()
        );

        $config->setNamingStrategy(new UnderscoreNamingStrategy());

        $eventManager = new EventManager();

        return EntityManager::create(
            [
                'driver' => 'pdo_mysql',
                'host' => environment('MYSQL_HOST'),
                'user' => environment('MYSQL_USER'),
                'password' => environment('MYSQL_PASSWORD'),
                'dbname' => environment('MYSQL_DATABASE'),
                'charset' => environment('MYSQL_CHARSET'),
            ],
            $config,
            $eventManager
        );
    },
    Connection::class => static function (ContainerInterface $container): Connection {
        $em = $container->get(EntityManagerInterface::class);
        return $em->getConnection();
    },
];
