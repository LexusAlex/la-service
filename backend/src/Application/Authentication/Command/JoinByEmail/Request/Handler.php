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
use LaService\Application\Authentication\Service\JoinConfirmationSender;
use LaService\Application\Authentication\Service\PasswordHasher;
use LaService\Application\Authentication\Service\Tokenizer;
use LaService\Component\Doctrine\Helper\Save;

final class Handler
{
    public function __construct(
        private readonly UserRepository $users,
        private readonly Save $save,
        private readonly PasswordHasher $hasher,
        private readonly Tokenizer $tokenizer,
        private readonly JoinConfirmationSender $sender
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

        $created_at = new DateTimeImmutable();
        $user = User::requestJoinByEmail(
            Id::generate(),
            $created_at,
            new DateTimeImmutable(),
            $email,
            $this->hasher->hash($command->password),
            $token = $this->tokenizer->generate($created_at)
        );

        $this->users->add($user);

        $this->save->save();

        $this->sender->send($email, $token);
    }
}
