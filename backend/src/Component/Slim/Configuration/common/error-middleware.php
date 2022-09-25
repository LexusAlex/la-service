<?php

declare(strict_types=1);

use LaService\Component\Slim\ErrorHandler\LogErrorHandler;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseFactoryInterface;
use Psr\Log\LoggerInterface;
use Slim\Interfaces\CallableResolverInterface;
use Slim\Middleware\ErrorMiddleware;

use function LaService\Component\Configuration\environment;

return [
    ErrorMiddleware::class => static function (ContainerInterface $container): ErrorMiddleware {
        $callableResolver = $container->get(CallableResolverInterface::class);
        $responseFactory = $container->get(ResponseFactoryInterface::class);

        $middleware = new ErrorMiddleware(
            $callableResolver,
            $responseFactory,
            (bool)environment('APPLICATION_DEBUG', '0'),
            true,
            true
        );

        $logger = $container->get(LoggerInterface::class);

        $middleware->setDefaultErrorHandler(
            new LogErrorHandler($callableResolver, $responseFactory, $logger),
        );

        return $middleware;
    },
];
