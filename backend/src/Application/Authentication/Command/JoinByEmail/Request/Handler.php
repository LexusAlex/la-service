<?php

declare(strict_types=1);

namespace LaService\Application\Authentication\Command\JoinByEmail\Request;

use DateTimeImmutable;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\NoResultException;
use DomainException;
use LaService\Application\Authentication\Entity\User\Types\Email;
use LaService\Application\Authentication\Entity\User\Types\Id;
use LaService\Application\Authentication\Entity\User\User;
use LaService\Application\Authentication\Entity\User\UserRepository;
use LaService\Component\Doctrine\Helper\Save;

final class Handler
{
    public function __construct(
        private readonly UserRepository $users,
        private readonly Save $save
    ) {
    }

    public function handle(Command $command): void
    {
        $email = new Email($command->email);

        try {
            if ($this->users->hasByEmail($email)) {
                throw new DomainException('User already exists.');
            }
        } catch (NoResultException|NonUniqueResultException $e) {
        }

        $user = User::requestJoinByEmail(
            Id::generate(),
            new DateTimeImmutable(),
            new DateTimeImmutable(),
            $email
        );

        $this->users->add($user);

        $this->save->save();
    }
}
