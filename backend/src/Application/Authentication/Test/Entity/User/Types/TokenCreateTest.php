<?php

declare(strict_types=1);

namespace LaService\Application\Authentication\Test\Entity\User\Types;

use DateTimeImmutable;
use InvalidArgumentException;
use LaService\Application\Authentication\Entity\User\Types\Token;
use PHPUnit\Framework\TestCase;
use Ramsey\Uuid\Uuid;

/**
 * @internal
 */
final class TokenCreateTest extends TestCase
{
    public function testSuccess(): void
    {
        $token = new Token(
            $value = Uuid::uuid4()->toString(),
            $expires = new DateTimeImmutable()
        );

        self::assertEquals($value, $token->getValue());
        self::assertEquals($expires, $token->getExpires());
    }

    public function testCase(): void
    {
        $value = Uuid::uuid4()->toString();

        $token = new Token(mb_strtoupper($value), new DateTimeImmutable());

        self::assertEquals($value, $token->getValue());
    }

    public function testIncorrect(): void
    {
        $this->expectException(InvalidArgumentException::class);
        new Token('12345', new DateTimeImmutable());
    }

    public function testEmpty(): void
    {
        $this->expectException(InvalidArgumentException::class);
        new Token('', new DateTimeImmutable());
    }
}
