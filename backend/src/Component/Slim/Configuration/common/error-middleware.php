<?php

declare(strict_types=1);
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseFactoryInterface;
use Slim\Interfaces\CallableResolverInterface;
use Slim\Middleware\ErrorMiddleware;

return [
    ErrorMiddleware::class => static function (ContainerInterface $container): ErrorMiddleware {
        $callableResolver = $container->get(CallableResolverInterface::class);
        $responseFactory = $container->get(ResponseFactoryInterface::class);



        $middleware = new ErrorMiddleware(
            $callableResolver,
            $responseFactory,
            true,
            true,
            true
        );

        return $middleware;
    },
];