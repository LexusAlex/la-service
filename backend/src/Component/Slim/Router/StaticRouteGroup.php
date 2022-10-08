<?php

declare(strict_types=1);

namespace LaService\Component\Slim\Router;

use Slim\Routing\RouteCollectorProxy;

final class StaticRouteGroup
{
    private $callable;

    public function __construct(callable $callable)
    {
        $this->callable = $callable;
    }

    public function __invoke(RouteCollectorProxy $group): mixed
    {
        return ($this->callable)($group);
    }
}
