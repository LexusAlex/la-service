<?php

declare(strict_types=1);

use Doctrine\Migrations\DependencyFactory;
use Doctrine\Migrations\Tools\Console\Command\CurrentCommand;
use Doctrine\Migrations\Tools\Console\Command\DiffCommand;
use Doctrine\Migrations\Tools\Console\Command\ExecuteCommand;
use Doctrine\Migrations\Tools\Console\Command\GenerateCommand;
use Doctrine\Migrations\Tools\Console\Command\LatestCommand;
use Doctrine\Migrations\Tools\Console\Command\ListCommand;
use Doctrine\Migrations\Tools\Console\Command\MigrateCommand;
use Doctrine\Migrations\Tools\Console\Command\StatusCommand;
use Doctrine\Migrations\Tools\Console\Command\UpToDateCommand;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Tools\Console\Command\InfoCommand;
use Doctrine\ORM\Tools\Console\Command\MappingDescribeCommand;
use Doctrine\ORM\Tools\Console\Command\SchemaTool\DropCommand;
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
        $cli->add($container->get(InfoCommand::class));
        $cli->add($container->get(MappingDescribeCommand::class));
        $cli->add($container->get(DropCommand::class));

        $dependencyFactory = $container->get(DependencyFactory::class);

        $cli->addCommands([
            new DiffCommand($dependencyFactory),
            new ExecuteCommand($dependencyFactory),
            new MigrateCommand($dependencyFactory),
            new LatestCommand($dependencyFactory),
            new ListCommand($dependencyFactory),
            new StatusCommand($dependencyFactory),
            new UpToDateCommand($dependencyFactory),
            new GenerateCommand($dependencyFactory),
            new CurrentCommand($dependencyFactory),
        ]);
        $cli->run();
        return $cli;
    },
];
