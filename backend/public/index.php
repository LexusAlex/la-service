<?php

declare(strict_types=1);

require __DIR__ . '/../vendor/autoload.php';

http_response_code(500);

$dependencies = (require __DIR__ . '/../src/Component/Configuration/dependencies.php');

$container = (require __DIR__ . '/../src/Component/Configuration/container.php')($dependencies);

$application = (require __DIR__ . '/../src/Component/Configuration/application.php')($container);

$application->run();
