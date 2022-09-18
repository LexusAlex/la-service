<?php

declare(strict_types=1);
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseFactoryInterface;
use Slim\Interfaces\CallableResolverInterface;
use Slim\Middleware\ErrorMiddleware;
use function LaService\Component\Configuration\environment;

return [
    ErrorMiddleware::class => function (ContainerInterface $container): ErrorMiddleware {
        $callableResolver = $container->get(CallableResolverInterface::class);
        $responseFactory = $container->get(ResponseFactoryInterface::class);

        return new ErrorMiddleware(
            $callableResolver,
            $responseFactory,
            (boolean)environment('APPLICATION_DEBUG', '0'),
            true,
            true
        );
    },
];