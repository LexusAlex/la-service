<?php

declare(strict_types=1);

use LaService\ApiGateway\Http\Middleware\ClearEmptyInput;
use LaService\ApiGateway\Http\Middleware\DomainExceptionHandler;
use LaService\ApiGateway\Http\Middleware\ValidationExceptionHandler;
use Slim\App;
use Slim\Middleware\ErrorMiddleware;

return static function (App $application): void {
    // Выполнение action
    // Новые тут
    $application->add(DomainExceptionHandler::class);
    $application->add(ValidationExceptionHandler::class);
    $application->add(ClearEmptyInput::class);
    $application->addBodyParsingMiddleware();
    $application->add(ErrorMiddleware::class);
};
