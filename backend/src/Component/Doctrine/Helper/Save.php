<?php

declare(strict_types=1);

namespace LaService\Component\Doctrine\Helper;

use Doctrine\ORM\EntityManagerInterface;

final class Save
{
    private EntityManagerInterface $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function save(): void
    {
        $this->em->flush();
    }
}
