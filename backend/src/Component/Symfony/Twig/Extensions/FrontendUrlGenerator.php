<?php

declare(strict_types=1);

namespace LaService\Component\Symfony\Twig\Extensions;

final class FrontendUrlGenerator
{
    public function __construct(private readonly string $baseUrl)
    {
    }

    public function generate(string $uri, array $params = []): string
    {
        return $this->baseUrl
            . ($uri ? '/' . $uri : '')
            . ($params ? '?' . http_build_query($params) : '');
    }
}
