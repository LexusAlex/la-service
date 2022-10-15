<?php

declare(strict_types=1);

namespace LaService\Component\Symfony\Test\Serializer;

use LaService\Component\Symfony\Serializer\Normalizer;
use PHPUnit\Framework\TestCase;
use stdClass;
use Symfony\Component\Serializer\Exception\ExceptionInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

/**
 * @internal
 */
final class NormalizerTest extends TestCase
{
    /**
     * @throws ExceptionInterface
     */
    public function testValid(): void
    {
        $object = new stdClass();

        $origin = $this->createMock(NormalizerInterface::class);
        $origin->expects(self::once())->method('normalize')
            ->with($object)
            ->willReturn(['name' => 'John']);

        $normalizer = new Normalizer($origin);

        $result = $normalizer->normalize($object);

        self::assertSame(['name' => 'John'], $result);
    }
}
