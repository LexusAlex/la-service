<?php

declare(strict_types=1);

use LaService\Application\Authentication\Service\Tokenizer;

return [
    Tokenizer::class => static fn (): Tokenizer => new Tokenizer(new DateInterval('PT1H')),
];
