<?php

declare(strict_types=1);

namespace LaService\Component\Configuration;

use RuntimeException;

function environment(string $name, ?string $default = null): string
{
    $value = getenv($name);

    if ($value !== false) {
        return $value;
    }

    $file = getenv($name . '_FILE');

    if ($file !== false) {
        return trim(file_get_contents($file));
    }

    if ($default !== null) {
        return $default;
    }

    throw new RuntimeException('Undefined env ' . $name);
}