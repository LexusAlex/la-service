<?php

declare(strict_types=1);

namespace LaService\Application\Authentication\Test\Entity\User;

use LaService\Application\Authentication\Entity\User\Types\Id;
use LaService\Application\Authentication\Entity\User\User;

final class UserBuilder
{
    private Id $id;

    public function __construct()
    {
        $this->id = Id::generate();
    }

    public function withId(Id $id): self
    {
        $clone = clone $this;
        $clone->id = $id;
        return $clone;
    }

    public function build(): User
    {
        return User::requestJoinByEmail(
            $this->id,
        );
    }
}
