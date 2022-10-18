<?php

declare(strict_types=1);

namespace LaService\Application\Authentication\Test\Entity\User;

use DateTimeImmutable;
use LaService\Application\Authentication\Entity\User\Types\Email;
use LaService\Application\Authentication\Entity\User\Types\Id;
use LaService\Application\Authentication\Entity\User\User;

final class UserBuilder
{
    private Id $id;
    private Email $email;
    private DateTimeImmutable $created_at;
    private DateTimeImmutable $updated_at;

    public function __construct()
    {
        $this->id = Id::generate();
        $this->email = new Email('mail@example.com');
        $this->created_at = new DateTimeImmutable();
        $this->updated_at = new DateTimeImmutable();
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
            $this->created_at,
            $this->updated_at,
            $this->email
        );
    }
}
