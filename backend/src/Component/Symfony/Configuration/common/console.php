<?php

declare(strict_types=1);

use Doctrine\Migrations\DependencyFactory;
use Doctrine\Migrations\Tools\Console\Command\MigrateCommand;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Tools\Console\Command\ValidateSchemaCommand;
use Doctrine\ORM\Tools\Console\EntityManagerProvider;
use Doctrine\ORM\Tools\Console\EntityManagerProvider\SingleManagerProvider;
use Psr\Container\ContainerInterface;
use Symfony\Component\Console\Application;

return [
    EntityManagerProvider::class => static fn (ContainerInterface $container): EntityManagerProvider => new SingleManagerProvider($container->get(EntityManagerInterface::class)),
    Application::class => static function (ContainerInterface $container): Application {
        $cli = new Application('Console');
        $cli->add($container->get(ValidateSchemaCommand::class));

        $dependencyFactory = $container->get(DependencyFactory::class);

        $cli->addCommands([
            new MigrateCommand($dependencyFactory),
        ]);
        $cli->run();
        return $cli;
    },
];
