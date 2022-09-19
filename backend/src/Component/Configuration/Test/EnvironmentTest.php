<?php

declare(strict_types=1);

namespace LaService\Component\Configuration\Test;

use PHPUnit\Framework\TestCase;
use RuntimeException;

use function LaService\Component\Configuration\environment;

/**
 * @internal
 */
final class EnvironmentTest extends TestCase
{
    public function testUndefined(): void
    {
        $this->expectException(RuntimeException::class);
        environment('APPLICATION_ENVIRONMENT1');
    }

    public function testEnvironmentType(): void
    {
        self::assertSame(environment('APPLICATION_ENVIRONMENT'), getenv('APPLICATION_ENVIRONMENT'), 'ENVIRONMENT not equals');
    }

    public function testEnvironmentDefault(): void
    {
        self::assertSame('prod', environment('APPLICATION_ENVIRONMENT123', 'prod'));
    }
}
