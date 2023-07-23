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

use Evrinoma\UtilsBundle\EvrinomaUtilsBundle;
use Evrinoma\UtilsBundle\Serialize\AbstractSerializerRegistry;
use Evrinoma\UtilsBundle\Serialize\SerializerInterface;
use Symfony\Component\Cache\Adapter\FilesystemAdapter;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Mapping\Factory\ClassMetadataFactory;
use Symfony\Component\Serializer\Mapping\Loader\LoaderChain;
use Symfony\Component\Serializer\NameConverter\CamelCaseToSnakeCaseNameConverter;
use Symfony\Component\Serializer\NameConverter\MetadataAwareNameConverter;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use Symfony\Component\Serializer\Normalizer\AbstractObjectNormalizer;
use Symfony\Component\Serializer\Normalizer\DateTimeNormalizer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\SerializerInterface as BasicSerializerInterface;

class SerializerSymfony extends AbstractSerializerRegistry implements SerializerInterface, SerializerSymfonyInterface
{
    protected int $circularReferenceLimit = 1;
    protected bool $skipNullValues = true;
    protected string $cachePrefix = EvrinomaUtilsBundle::BUNDLE;

    private array $files = [];

    private ?BasicSerializerInterface $serializer = null;

    protected ?string $group = null;

    private FilesystemAdapter $cache;

    public function __construct(string $cacheDir)
    {
        $this->cache = new FilesystemAdapter('', 0, $cacheDir.'/serializer');
    }

    public function setGroup(string $name): SerializerInterface
    {
        $this->group = $name;

        return $this;
    }

    public function setCircularReferenceLimit(int $circularReferenceLimit): SerializerInterface
    {
        $this->circularReferenceLimit = $circularReferenceLimit;

        return $this;
    }

    public function defaultContext(): array
    {
        return [
            AbstractNormalizer::CIRCULAR_REFERENCE_LIMIT => $this->circularReferenceLimit,
            AbstractNormalizer::GROUPS => $this->group,
            AbstractObjectNormalizer::SKIP_NULL_VALUES => $this->skipNullValues,
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
        $metadataCached = $this->cache->getItem('serializer.'.$this->cachePrefix.'.metadata');
        if (!$metadataCached->isHit()) {
            $classMetadataFactory = new ClassMetadataFactory(new LoaderChain($this->files));
            $metadataCached->set($classMetadataFactory);
            $this->cache->save($metadataCached);
        }
        $classMetadataFactory = $metadataCached->get();

        return [
            new DateTimeNormalizer(),
            new ObjectNormalizer(
                $classMetadataFactory,
                new MetadataAwareNameConverter($classMetadataFactory, new CamelCaseToSnakeCaseNameConverter()),
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

    private function create(): BasicSerializerInterface
    {
        $serializerCached = $this->cache->getItem('serializer.'.$this->cachePrefix.'.configuration');
        if (!$serializerCached->isHit()) {
            foreach ($this->getConfigurations() as $configuration) {
                $this->files[] = $configuration->getFile();
            }
            $serializerCached->set($this->files);
            $this->cache->save($serializerCached);
        }

        $this->files = $serializerCached->get();

        if (null === $this->serializer) {
            $this->serializer = new Serializer($this->normalizers(), $this->encoders());
        }

        return $this->serializer;
    }

    public function serialize($data, $format = 'json'): string
    {
        return $this->create()->serialize($data, $format, $this->defaultContext());
    }
}
