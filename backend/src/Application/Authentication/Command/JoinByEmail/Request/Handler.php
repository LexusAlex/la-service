<?php

declare(strict_types=1);

namespace LaService\Application\Authentication\Command\JoinByEmail\Request;

use LaService\Application\Authentication\Entity\User\Types\Id;
use LaService\Application\Authentication\Entity\User\User;
use LaService\Application\Authentication\Entity\User\UserRepository;

final class Handler
{
    public function __construct(
        private readonly UserRepository $users,
    ) {
    }

    public function handle(): void
    {
        $user = User::requestJoinByEmail(
            Id::generate()
        );

        $this->users->add($user);
    }
}
