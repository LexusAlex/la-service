<?php

declare(strict_types=1);

use Psr\Container\ContainerInterface;
use Slim\App;
use Slim\Factory\AppFactory;
use Slim\Middleware\ErrorMiddleware;

return static function (ContainerInterface $container): App {
    $application = AppFactory::createFromContainer($container);
    $application->add(ErrorMiddleware::class);
    //(require __DIR__ . '/middleware.php')($app);
    (require __DIR__ . '/routes.php')($application);
    return $application;
};
