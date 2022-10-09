<?php

declare(strict_types=1);

namespace LaService\ApiGateway\Http\Action\V1\Authentication;

use LaService\Application\Authentication\Command\JoinByEmail\Request\Handler;
use LaService\Component\Slim\Response\EmptyResponse;
use LaService\Component\Symfony\Validator\Validator;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

final class RequestAction implements RequestHandlerInterface
{
    public function __construct(
        private readonly Validator $validator,
        private readonly Handler $handler
    ) {
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        return new EmptyResponse(201);
    }
}
