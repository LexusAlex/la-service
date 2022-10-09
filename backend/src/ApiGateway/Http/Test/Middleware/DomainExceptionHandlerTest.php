<?php

declare(strict_types=1);

namespace LaService\ApiGateway\Http\Test\Middleware;

use DomainException;
use JsonException;
use LaService\ApiGateway\Http\Middleware\DomainExceptionHandler;
use PHPUnit\Framework\TestCase;
use Psr\Http\Server\RequestHandlerInterface;
use Psr\Log\LoggerInterface;
use Slim\Psr7\Factory\ResponseFactory;
use Slim\Psr7\Factory\ServerRequestFactory;

/**
 * @covers \DomainExceptionHandler
 *
 * @internal
 */
final class DomainExceptionHandlerTest extends TestCase
{
    public function testNormal(): void
    {
        $logger = $this->createMock(LoggerInterface::class);
        $logger->expects(self::never())->method('warning');

        $middleware = new DomainExceptionHandler($logger);

        $handler = $this->createStub(RequestHandlerInterface::class);
        $handler->method('handle')->willReturn($source = (new ResponseFactory())->createResponse());
        $request = (new ServerRequestFactory())->createServerRequest('POST', 'http://test');
        $response = $middleware->process($request, $handler);
        self::assertEquals($source, $response);
    }

    /**
     * @throws JsonException
     */
    public function testException(): void
    {
        $logger = $this->createMock(LoggerInterface::class);
        $logger->expects(self::once())->method('warning');

        $middleware = new DomainExceptionHandler($logger);

        $handler = $this->createStub(RequestHandlerInterface::class);
        $handler->method('handle')->willThrowException(new DomainException('Some error.'));
        $request = (new ServerRequestFactory())->createServerRequest('POST', 'http://test');
        $response = $middleware->process($request, $handler);
        self::assertEquals(409, $response->getStatusCode());
        self::assertJson($body = (string)$response->getBody());
        /** @var array $data */
        $data = json_decode($body, true, 512, JSON_THROW_ON_ERROR);
        self::assertEquals([
            'message' => 'Some error.',
        ], $data);
    }
}
