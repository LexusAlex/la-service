<?php

declare(strict_types=1);

namespace LaService\ApiGateway\Http\Test;

use JsonException;
use PHPUnit\Framework\TestCase;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\App;
use Slim\Psr7\Factory\ServerRequestFactory;

abstract class WebTestCase extends TestCase
{
    protected static function json(string $method, string $path, array $body = []): ServerRequestInterface
    {
        $request = self::request($method, $path)
            ->withHeader('Accept', 'application/json')
            ->withHeader('Content-Type', 'application/json');
        try {
            $request->getBody()->write(json_encode($body, JSON_THROW_ON_ERROR));
        } catch (JsonException $e) {
            echo $e->getMessage();
        }
        return $request;
    }

    protected function app(): App
    {
        return (require __DIR__ . '/../../../Component/Configuration/application.php')($this->container());
    }

    private static function request(string $method, string $path): ServerRequestInterface
    {
        return (new ServerRequestFactory())->createServerRequest($method, $path);
    }

    private function container(): ContainerInterface
    {
        $dependencies = (require __DIR__ . '/../../../Component/Configuration/dependencies.php');
        return (require __DIR__ . '/../../../Component/Configuration/container.php')($dependencies);
    }
}
