<?php

declare(strict_types=1);

namespace LaService\ApiGateway\Http\Test;

/**
 * @internal
 */
final class HomeTest extends WebTestCase
{
    public function testSuccess(): void
    {
        $response = $this->app()->handle(
            self::json('GET', '/')->withHeader('X-Features', '!NEW_HOME')
        );

        self::assertEquals(200, $response->getStatusCode());
        self::assertEquals('application/json', $response->getHeaderLine('Content-Type'));
        self::assertEquals('{}', (string)$response->getBody());
    }

    public function testMethod(): void
    {
        $response = $this->app()->handle(self::json('POST', '/'));

        self::assertEquals(405, $response->getStatusCode());
    }
}
