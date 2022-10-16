<?php

declare(strict_types=1);

namespace LaService\Application\Authentication\Entity\User;

use Doctrine\ORM\EntityManagerInterface;
use DomainException;
use LaService\Application\Authentication\Entity\User\Types\Id;

final class UserRepository
{
    public function __construct(
        private readonly EntityManagerInterface $entityManager
    ) {
    }

    public function get(Id $id): User
    {
        $user = $this->entityManager->getRepository(User::class)->find($id->getValue());
        if ($user === null) {
            throw new DomainException('User is not found.');
        }
        return $user;
    }

    public function add(User $user): void
    {
        $this->entityManager->persist($user);
    }

    public function remove(User $user): void
    {
        $this->entityManager->remove($user);
    }
}
