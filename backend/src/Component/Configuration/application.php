<?php

declare(strict_types=1);

use Psr\Container\ContainerInterface;
use Slim\App;
use Slim\Factory\AppFactory;

return static function (ContainerInterface $container): App {
    $application = AppFactory::createFromContainer($container);
    (require __DIR__ . '/middleware.php')($application);
    (require __DIR__ . '/routes.php')($application);
    return $application;
};
