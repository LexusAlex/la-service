<?php

declare(strict_types=1);

namespace LaService\Application\Authentication\Test\Entity\User\Command\JoinByEmail;

use DateTimeImmutable;
use LaService\Application\Authentication\Entity\User\Types\Email;
use LaService\Application\Authentication\Entity\User\Types\Id;
use LaService\Application\Authentication\Entity\User\User;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 */
final class RequestTest extends TestCase
{
    public function testSuccess(): void
    {
        $user = User::requestJoinByEmail(
            $id = Id::generate(),
            $created_at = new DateTimeImmutable(),
            $updated_at = new DateTimeImmutable(),
            $email = new Email('mail@example.com')
        );

        self::assertEquals($id, $user->getId());
        self::assertEquals($created_at, $user->getCreatedAt());
        self::assertEquals($updated_at, $user->getUpdatedAt());
        self::assertEquals($email, $user->getEmail());
    }
}
