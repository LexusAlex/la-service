<?php

declare(strict_types=1);

use Psr\Container\ContainerInterface;
use Psr\Log\LoggerInterface;
use Symfony\Component\EventDispatcher\EventDispatcher;
use Symfony\Component\Mailer\EventListener\EnvelopeListener;
use Symfony\Component\Mailer\Mailer;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mailer\Transport\Smtp\EsmtpTransport;
use Symfony\Component\Mime\Address;

use function LaService\Component\Configuration\environment;

return [
    MailerInterface::class => static function (ContainerInterface $container): MailerInterface {
        $dispatcher = new EventDispatcher();

        $dispatcher->addSubscriber(new EnvelopeListener(new Address(
            environment('MAILER_FROM_EMAIL'),
            environment('MAILER_FROM_NAME'),
        )));

        $transport = (new EsmtpTransport(
            environment('MAILER_HOST'),
            (int)environment('MAILER_PORT'),
            !environment('APPLICATION_DEBUG'),
            $dispatcher,
            $container->get(LoggerInterface::class)
        ))
            ->setUsername(environment('MAILER_USERNAME'))
            ->setPassword(environment('MAILER_PASSWORD'));

        return new Mailer($transport);
    },
];
