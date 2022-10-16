<?php

declare(strict_types=1);

namespace LaService\Application\Authentication\Entity\User;

use Doctrine\ORM\Mapping as ORM;
use LaService\Application\Authentication\Entity\User\Types\Id;

#[ORM\Entity]
#[ORM\HasLifecycleCallbacks]
#[ORM\Table(name: 'la_service_authentication_users')]
final class User
{
    #[ORM\Column(type: 'authentication_user_id')]
    #[ORM\Id]
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
