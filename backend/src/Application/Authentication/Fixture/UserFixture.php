<?php

declare(strict_types=1);

namespace LaService\Application\Authentication\Fixture;

use DateTimeImmutable;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Persistence\ObjectManager;
use LaService\Application\Authentication\Entity\User\Types\Email;
use LaService\Application\Authentication\Entity\User\Types\Id;
use LaService\Application\Authentication\Entity\User\Types\Token;
use LaService\Application\Authentication\Entity\User\User;
use Ramsey\Uuid\Uuid;

final class UserFixture extends AbstractFixture
{
    public function load(ObjectManager $manager): void
    {
        $created_at = new DateTimeImmutable('-30 days');
        $user = User::requestJoinByEmail(
            new Id('00000000-0000-0000-0000-000000000001'),
            $created_at,
            new DateTimeImmutable('-30 days'),
            new Email('user@app.test'),
            'password-hash',
            new Token(Uuid::uuid4()->toString(), $created_at->modify('+1 day'))
        );

        $manager->persist($user);

        $manager->flush();
    }
}
