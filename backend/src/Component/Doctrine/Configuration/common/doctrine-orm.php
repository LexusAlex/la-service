<?php

declare(strict_types=1);

use Doctrine\Common\EventManager;
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Types\Type;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Mapping\UnderscoreNamingStrategy;
use Doctrine\ORM\ORMSetup;
use LaService\Application\Authentication\Entity\User\Types\EmailType;
use LaService\Application\Authentication\Entity\User\Types\IdType;
use Psr\Container\ContainerInterface;
use Symfony\Component\Cache\Adapter\ArrayAdapter;
use Symfony\Component\Cache\Adapter\FilesystemAdapter;

use function LaService\Component\Configuration\environment;

return [
    EntityManagerInterface::class => static function (): EntityManagerInterface {
        $config = ORMSetup::createAttributeMetadataConfiguration(
            [
                __DIR__ . '/../../../../../src/Application/Authentication/Entity',
            ],
            (bool)environment('APPLICATION_ENVIRONMENT', 'production'),
            __DIR__ . '/../../../../../var/cache/' . PHP_SAPI . 'doctrine/proxy',
            !environment('APPLICATION_DEBUG') ? (__DIR__ . '/../../../../../var/cache/' . PHP_SAPI . 'doctrine/cache') ? new FilesystemAdapter('', 0, __DIR__ . '/../../../../../var/cache/' . PHP_SAPI . '/doctrine/cache') : new ArrayAdapter() : null
        );

        $config->setNamingStrategy(new UnderscoreNamingStrategy());

        $types = [
            IdType::NAME => IdType::class,
            EmailType::NAME => EmailType::class,
        ];

        foreach ($types as $name => $class) {
            if (!Type::hasType($name)) {
                Type::addType($name, $class);
            }
        }

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
