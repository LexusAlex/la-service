<?php

declare(strict_types=1);

use Doctrine\Common\Annotations\AnnotationReader;
use Psr\Container\ContainerInterface;
use Symfony\Component\PropertyInfo\Extractor\PhpDocExtractor;
use Symfony\Component\PropertyInfo\Extractor\ReflectionExtractor;
use Symfony\Component\PropertyInfo\PropertyInfoExtractor;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Mapping\Factory\ClassMetadataFactory;
use Symfony\Component\Serializer\Mapping\Loader\AnnotationLoader;
use Symfony\Component\Serializer\Normalizer\ArrayDenormalizer;
use Symfony\Component\Serializer\Normalizer\DateTimeNormalizer;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Symfony\Component\Serializer\Normalizer\PropertyNormalizer;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\SerializerInterface;

return [
    NormalizerInterface::class => static fn (ContainerInterface $container): SerializerInterface => $container->get(SerializerInterface::class),
    DenormalizerInterface::class => static fn (ContainerInterface $container): SerializerInterface => $container->get(SerializerInterface::class),
    SerializerInterface::class => static function (): SerializerInterface {
        return new Serializer([
            ...[],
            new DateTimeNormalizer(),
            new PropertyNormalizer(
                classMetadataFactory: new ClassMetadataFactory(new AnnotationLoader(new AnnotationReader())),
                propertyTypeExtractor: new PropertyInfoExtractor(
                    typeExtractors: [
                        new PhpDocExtractor(),
                        new ReflectionExtractor(),
                    ]
                )
            ),

            new ArrayDenormalizer(),
        ], [
            new JsonEncoder(),
        ]);
    },
];
