#!/usr/bin/env php
<?php

declare(strict_types=1);

use Symfony\Component\Console\Application;

require __DIR__ . '/../vendor/autoload.php';

$cli = new Application('Console');

try {
    $cli->run();
} catch (Exception $e) {
    echo $e->getMessage();
}
