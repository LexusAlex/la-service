<?php

declare(strict_types=1);

use Laminas\ConfigAggregator\ConfigAggregator;
use Laminas\ConfigAggregator\PhpFileProvider;

use function LaService\Component\Configuration\environment;

$modules = [
    'Component' => ['Configuration', 'Slim', 'Monolog'],
    'Application' => [],
];

$configuration = [];

foreach ($modules as $nameModule => $module) {
    foreach ($module as $component) {
        $configuration[] = new PhpFileProvider(__DIR__ . "/../../{$nameModule}/{$component}/Configuration/common/*.php");
        $configuration[] = new PhpFileProvider(__DIR__ . "/../../{$nameModule}/{$component}/Configuration/" . environment('APPLICATION_ENVIRONMENT', 'production') . '/*.php');
    }
}

$aggregator = new ConfigAggregator($configuration);

return $aggregator->getMergedConfig();
