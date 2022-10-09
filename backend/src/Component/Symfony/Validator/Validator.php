<?php

declare(strict_types=1);

namespace LaService\Component\Symfony\Validator;

use Symfony\Component\Validator\Validator\ValidatorInterface;

final class Validator
{
    public function __construct(private readonly ValidatorInterface $validator)
    {
    }

    public function validate(object $object): void
    {
        $violations = $this->validator->validate($object);
        if ($violations->count() > 0) {
            throw new ValidationException($violations);
        }
    }
}
