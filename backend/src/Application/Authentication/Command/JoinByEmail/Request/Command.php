<?php

declare(strict_types=1);

namespace LaService\Application\Authentication\Command\JoinByEmail\Request;

final class Command
{
    public function __construct(
        public readonly string $email = '',
        public readonly string $password = ''
    ) {
    }
}
