<?php

declare(strict_types=1);

namespace LaService\Component\Configuration\Test;

use function LaService\Component\Configuration\environment;

use PHPUnit\Framework\TestCase;
use RuntimeException;

/**
 * @internal
 *
 * @coversNothing
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
        static::assertSame(environment('APPLICATION_ENVIRONMENT'), getenv('APPLICATION_ENVIRONMENT'), 'ENVIRONMENT not equals');
    }

    public function testEnvironmentDefault(): void
    {
        static::assertSame('prod', environment('APPLICATION_ENVIRONMENT123', 'prod'));
    }
}
