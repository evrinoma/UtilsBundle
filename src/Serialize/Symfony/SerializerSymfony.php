<?php

declare(strict_types=1);

/*
 * This file is part of the package.
 *
 * (c) Nikolay Nikolaev <evrinoma@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Evrinoma\UtilsBundle\Serialize\Symfony;

use Evrinoma\UtilsBundle\Serialize\AbstractSerializerRegistry;
use Evrinoma\UtilsBundle\Serialize\SerializerInterface;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Mapping\Factory\ClassMetadataFactory;
use Symfony\Component\Serializer\Mapping\Loader\LoaderChain;
use Symfony\Component\Serializer\NameConverter\CamelCaseToSnakeCaseNameConverter;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use Symfony\Component\Serializer\Normalizer\DateTimeNormalizer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\SerializerInterface as BasicSerializerInterface;

class SerializerSymfony extends AbstractSerializerRegistry implements SerializerInterface, SerializerSymfonyInterface
{
    private array $files = [];

    private BasicSerializerInterface $serializer;

    private ?string $group = null;

    public function __construct()
    {
        $this->getConfigurations();

        $this->serializer = new Serializer($this->normalizers(), $this->encoders());
    }

    public function setGroup(string $name): SerializerInterface
    {
        $this->group = $name;

        return $this;
    }

    public function defaultContext(): array
    {
        return [
            AbstractNormalizer::CIRCULAR_REFERENCE_LIMIT => 2,
            AbstractNormalizer::GROUPS => $this->group,
        ];
    }

    public function encoders(): array
    {
        return [
            new JsonEncoder(),
        ];
    }

    public function normalizers(): array
    {
        return [
            new DateTimeNormalizer(),
            new ObjectNormalizer(
                new ClassMetadataFactory(new LoaderChain($this->files)),
                new CamelCaseToSnakeCaseNameConverter(),
                null,
                null,
                null,
                null,
                [
                    AbstractNormalizer::CIRCULAR_REFERENCE_HANDLER => function (object $object, string $format, array $context) {
                        return null;
                    },
                ]
            ),
        ];
    }

    public function serialize($data, $format = 'json'): string
    {
        return $this->serializer->serialize($data, $format, $this->defaultContext());
    }
}
