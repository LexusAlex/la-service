<?php

declare(strict_types=1);

use Psr\Container\ContainerInterface;
use Slim\App;
use Slim\Factory\AppFactory;

return static function (ContainerInterface $container): App {
    $application = AppFactory::createFromContainer($container);
    $application->addErrorMiddleware(false,false,false);
    //(require __DIR__ . '/middleware.php')($app);
    (require __DIR__ . '/routes.php')($application);
    return $application;
};
