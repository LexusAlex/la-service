<?php

declare(strict_types=1);

namespace LaService\ApiGateway\Http\Action\V1\Authentication;

use LaService\Application\Authentication\Command\JoinByEmail\Request\Command;
use LaService\Application\Authentication\Command\JoinByEmail\Request\Handler;
use LaService\Component\Slim\Response\EmptyResponse;
use LaService\Component\Symfony\Serializer\Denormalizer;
use LaService\Component\Symfony\Validator\Validator;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Symfony\Component\Serializer\Exception\ExceptionInterface;

final class RequestAction implements RequestHandlerInterface
{
    public function __construct(
        private readonly Denormalizer $denormalizer,
        private readonly Validator $validator,
        private readonly Handler $handler
    ) {
    }

    /**
     * @throws ExceptionInterface
     */
    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $command = $this->denormalizer->denormalize($request->getParsedBody(), Command::class);

        $this->validator->validate($command);

        $this->handler->handle();

        return new EmptyResponse(201);
    }
}
