<?php

declare(strict_types=1);

use LaService\Component\Symfony\Twig\Extensions\FrontendUrlGenerator;
use LaService\Component\Symfony\Twig\Extensions\FrontendUrlTwigExtension;
use Psr\Container\ContainerInterface;
use Twig\Environment;
use Twig\Extension\DebugExtension;
use Twig\Loader\FilesystemLoader;

use function LaService\Component\Configuration\environment;

return [
    FrontendUrlGenerator::class => static fn (): FrontendUrlGenerator => new FrontendUrlGenerator(environment('FRONTEND_URL')),
    Environment::class => static function (ContainerInterface $container): Environment {
        $loader = new FilesystemLoader();

        $loader->addPath(__DIR__ . '/../../Twig/templates');

        $debug = (bool)environment('APPLICATION_DEBUG');
        $environment = new Environment($loader, [
            'cache' => $debug ? false : (__DIR__ . '/../../../../../var/cache/twig'),
            'debug' => $debug,
            'strict_variables' => $debug,
            'auto_reload' => $debug,
        ]);

        if ($debug) {
            $environment->addExtension(new DebugExtension());
        }

        $environment->addExtension($container->get(FrontendUrlTwigExtension::class));

        return $environment;
    },
];
