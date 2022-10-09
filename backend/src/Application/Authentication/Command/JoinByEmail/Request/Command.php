<?php

declare(strict_types=1);

namespace LaService\Application\Authentication\Command\JoinByEmail\Request;

use Symfony\Component\Validator\Constraints as Assert;

final class Command
{
    public function __construct(
        #[Assert\NotBlank]
        #[Assert\Email]
        public readonly string $email = '',
        #[Assert\NotBlank]
        #[Assert\Length(min: 8)]
        public readonly string $password = ''
    ) {
    }
}
