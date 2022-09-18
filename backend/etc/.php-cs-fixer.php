<?php

declare(strict_types=1);

return
    (new PhpCsFixer\Config())
        ->setCacheFile(__DIR__.'/../var/cache/.php_cs')
        ->setFinder(
            PhpCsFixer\Finder::create()
                ->in([
                    __DIR__.'/../public',
                    __DIR__.'/../src',
                ])
                ->append([
                    __FILE__,
                ])
        )
        ->setRules([
            '@PSR12' => true,
            '@PSR12:risky' => true,
            '@DoctrineAnnotation' => true,
            '@PHP80Migration' => true,
            '@PHP80Migration:risky' => true,
            '@PHPUnit84Migration:risky' => true,
            '@PhpCsFixer' => true,
            '@PhpCsFixer:risky' => true,

            'final_class' => false,
        ])
;
