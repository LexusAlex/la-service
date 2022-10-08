<?php

declare(strict_types=1);

namespace LaService\Application\Authentication\Test\Entity\User\Command\JoinByEmail;

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
        );

        self::assertEquals($id, $user->getId());
    }
}
