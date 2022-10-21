<?php

declare(strict_types=1);

namespace LaService\Application\Authentication\Service;

use LaService\Application\Authentication\Entity\User\Types\Email;
use LaService\Application\Authentication\Entity\User\Types\Token;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email as MimeEmail;
use Twig\Environment;

final class JoinConfirmationSender
{
    public function __construct(private readonly MailerInterface $mailer, private readonly Environment $twig)
    {
    }

    public function send(Email $email, Token $token): void
    {
        $message = (new MimeEmail())
            ->subject('Join Confirmation')
            ->to($email->getValue())
            ->html($this->twig->render('authentication/joinByEmail/confirm.html.twig', ['token' => $token]), 'text/html');

        $this->mailer->send($message);
    }
}
