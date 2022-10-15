<?php

declare(strict_types=1);

namespace LaService\Application\Authentication\Command\JoinByEmail\Request;

use LaService\Application\Authentication\Entity\User\Types\Id;
use LaService\Application\Authentication\Entity\User\User;

final class Handler
{
    public function __construct(
    ) {
    }

    public function handle(): User
    {
        return User::requestJoinByEmail(
            Id::generate()
        );
    }
}
