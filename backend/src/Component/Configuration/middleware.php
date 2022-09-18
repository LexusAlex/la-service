<?php

declare(strict_types=1);

use Slim\App;
use Slim\Middleware\ErrorMiddleware;

return static function (App $application): void {
    // Выполнение action
    // Новые тут
    $application->addBodyParsingMiddleware();
    $application->add(ErrorMiddleware::class);
};