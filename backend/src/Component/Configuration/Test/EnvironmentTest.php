<?php

declare(strict_types=1);

namespace LaService\Component\Configuration\Test;

use RuntimeException;
use PHPUnit\Framework\TestCase;
use function LaService\Component\Configuration\environment;

class EnvironmentTest extends TestCase
{
    public function testUndefined()
    {
        $this->expectException(RuntimeException::class);
        environment('APPLICATION_ENVIRONMENT1');
    }

    public function testEnvironmentType()
    {
        self::assertEquals(environment('APPLICATION_ENVIRONMENT'), getenv('APPLICATION_ENVIRONMENT'),'ENVIRONMENT not equals');
    }

    public function testEnvironmentDefault()
    {
        self::assertEquals('prod',environment('APPLICATION_ENVIRONMENT123', 'prod'));
    }
}