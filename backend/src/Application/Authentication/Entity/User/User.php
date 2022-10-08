<?php

declare(strict_types=1);

namespace LaService\Application\Authentication\Entity\User;

use LaService\Application\Authentication\Entity\User\Types\Id;

final class User
{
    private Id $id;

    public function __construct(Id $id)
    {
        $this->id = $id;
    }

    public function getId(): Id
    {
        return $this->id;
    }

    public static function requestJoinByEmail(
        Id $id,
    ): self {
        return new self($id);
    }
}
