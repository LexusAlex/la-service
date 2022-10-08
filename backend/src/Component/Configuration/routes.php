<?php

declare(strict_types=1);

use LaService\ApiGateway\Http\Action\HomeAction;
use LaService\ApiGateway\Http\Action\V1\Authentication\RequestAction;
use LaService\Component\Slim\Router\StaticRouteGroup as Group;
use Slim\App;
use Slim\Routing\RouteCollectorProxy;

return static function (App $application): void {
    $application->get('/', HomeAction::class);
    $application->group('/v1', new Group(static function (RouteCollectorProxy $group): void {
        $group->group('/authentication', new Group(static function (RouteCollectorProxy $group): void {
            $group->post('/join', RequestAction::class);
        }));
    }));
};
