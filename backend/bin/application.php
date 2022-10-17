#!/usr/bin/env php
<?php

declare(strict_types=1);

use Psr\Container\ContainerExceptionInterface;
use Psr\Container\ContainerInterface;
use Psr\Container\NotFoundExceptionInterface;
use Symfony\Component\Console\Application;

require __DIR__ . '/../vendor/autoload.php';

/** @var ContainerInterface $container */
$container = (require __DIR__ . '/../src/Component/Configuration/container.php')(require __DIR__ . '/../src/Component/Configuration/dependencies.php');

try {
    $container->get(Application::class);
} catch (NotFoundExceptionInterface|ContainerExceptionInterface $e) {
}
