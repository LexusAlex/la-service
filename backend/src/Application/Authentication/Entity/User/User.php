<?php

declare(strict_types=1);

namespace LaService\Application\Authentication\Entity\User;

use DateTimeImmutable;
use Doctrine\ORM\Mapping as ORM;
use LaService\Application\Authentication\Entity\User\Types\Email;
use LaService\Application\Authentication\Entity\User\Types\Id;
use LaService\Application\Authentication\Entity\User\Types\Token;

#[ORM\Entity]
#[ORM\HasLifecycleCallbacks]
#[ORM\Table(name: 'la_service_authentication_users')]
final class User
{
    #[ORM\Column(type: 'authentication_user_id')]
    #[ORM\Id]
    private Id $id;

    #[ORM\Column(type: 'datetime_immutable')]
    private DateTimeImmutable $createdAt;

    #[ORM\Column(type: 'datetime_immutable')]
    private DateTimeImmutable $updatedAt;

    #[ORM\Column(type: 'authentication_user_email', unique: true)]
    private Email $email;

    #[ORM\Column(type: 'string', nullable: true)]
    private ?string $passwordHash = null;

    #[ORM\Embedded(class: Token::class)]
    private ?Token $joinConfirmToken = null;

    public function __construct(Id $id, DateTimeImmutable $createdAt, DateTimeImmutable $updatedAt, Email $email)
    {
        $this->id = $id;
        $this->createdAt = $createdAt;
        $this->updatedAt = $updatedAt;
        $this->email = $email;
    }

    public function getId(): Id
    {
        return $this->id;
    }

    public function getCreatedAt(): DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function getUpdatedAt(): DateTimeImmutable
    {
        return $this->updatedAt;
    }

    public function getEmail(): Email
    {
        return $this->email;
    }

    public function getPasswordHash(): ?string
    {
        return $this->passwordHash;
    }

    public function getJoinConfirmToken(): ?Token
    {
        return $this->joinConfirmToken;
    }

    public static function requestJoinByEmail(
        Id $id,
        DateTimeImmutable $createdAt,
        DateTimeImmutable $updatedAt,
        Email $email,
        string $passwordHash,
        Token $token
    ): self {
        $user = new self($id, $createdAt, $updatedAt, $email);
        $user->passwordHash = $passwordHash;
        $user->joinConfirmToken = $token;
        return $user;
    }

    #[ORM\PostLoad]
    public function checkEmbeds(): void
    {
        if ($this->joinConfirmToken && $this->joinConfirmToken->isEmpty()) {
            $this->joinConfirmToken = null;
        }
    }
}
