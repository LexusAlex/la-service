<?php

declare(strict_types=1);

namespace LaService\Application\Authentication\Service;

use DateInterval;
use DateTimeImmutable;
use LaService\Application\Authentication\Entity\User\Types\Token;
use Ramsey\Uuid\Uuid;

final class Tokenizer
{
    public function __construct(private readonly DateInterval $interval)
    {
    }

    public function generate(DateTimeImmutable $date): Token
    {
        return new Token(
            Uuid::uuid4()->toString(),
            $date->add($this->interval)
        );
    }
}
