#!/usr/bin/env php
<?php

declare(strict_types=1);

use Doctrine\ORM\Tools\Console\Command\ValidateSchemaCommand;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\ContainerInterface;
use Psr\Container\NotFoundExceptionInterface;
use Symfony\Component\Console\Application;

require __DIR__ . '/../vendor/autoload.php';

$cli = new Application('Console');

$dependencies = (require __DIR__ . '/../src/Component/Configuration/dependencies.php');
/** @var ContainerInterface $container */
$container = (require __DIR__ . '/../src/Component/Configuration/container.php')($dependencies);

try {
    $cli->add($container->get(ValidateSchemaCommand::class));
} catch (NotFoundExceptionInterface|ContainerExceptionInterface $e) {
}

try {
    $cli->run();
} catch (Exception $e) {
    echo $e->getMessage();
}
