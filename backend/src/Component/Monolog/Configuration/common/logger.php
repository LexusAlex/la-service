<?php

declare(strict_types=1);

use Monolog\Handler\RotatingFileHandler;
use Monolog\Logger;
use Psr\Log\LoggerInterface;

return [
    LoggerInterface::class => static function () {
        $file = __DIR__ . '/../../../../../var/log/' . PHP_SAPI . '/application.log';
        $logger = new Logger('la-service');

        if (!empty($file)) {
            $logger->pushHandler(new RotatingFileHandler($file));
        }

        return $logger;
    },
];
