<?php

declare(strict_types=1);

namespace LaService\Application\Authentication\Test\Entity\User\Types;

use DateTimeImmutable;
use LaService\Application\Authentication\Entity\User\Types\Token;
use PHPUnit\Framework\TestCase;
use Ramsey\Uuid\Uuid;

/**
 * @internal
 */
final class TokenExpiresTest extends TestCase
{
    public function testNot(): void
    {
        $token = new Token(
            Uuid::uuid4()->toString(),
            $expires = new DateTimeImmutable()
        );

        self::assertFalse($token->isExpiredTo($expires->modify('-1 secs')));
        self::assertTrue($token->isExpiredTo($expires));
        self::assertTrue($token->isExpiredTo($expires->modify('+1 secs')));
    }
}
