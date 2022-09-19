<?php

declare(strict_types=1);

namespace LaService\Component\Configuration;

use RuntimeException;

function environment(string $name, ?string $default = null): string
{
    $value = getenv($name);

    if (false !== $value) {
        return $value;
    }

    $file = getenv($name . '_FILE');

    if (false !== $file) {
        return trim(file_get_contents($file));
    }

    if (null !== $default) {
        return $default;
    }

    throw new RuntimeException('Undefined environment ' . $name);
}
