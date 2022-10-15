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

namespace Evrinoma\UtilsBundle\Mapping;

use Doctrine\Common\Annotations\Reader;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\ManyToMany;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\OneToMany;
use Doctrine\Common\Collections\Collection;
use Evrinoma\UtilsBundle\Exception\MetadataHydrateException;
use Evrinoma\UtilsBundle\Exception\MetadataNotFoundException;
use Psr\Cache\InvalidArgumentException;
use Symfony\Component\Cache\Adapter\FilesystemAdapter;

class MetadataManager implements MetadataManagerInterface
{
    private const IDENTITY = 'identity';
    private const MAP = 'map';
    private array             $aliases = [];
    private array             $metadata = [];
    private array             $identifiers = [];
    protected Reader          $annotationReader;
    private FilesystemAdapter $cache;

    /**
     * @param string $cacheDir
     * @param Reader $annotationReader
     */
    public function __construct(string $cacheDir, Reader $annotationReader)
    {
        $this->annotationReader = $annotationReader;
        $this->cache = new FilesystemAdapter('', 0, $cacheDir.'/meta');
    }

    /**
     * @param string      $entity
     * @param string|null $alias
     *
     * @throws InvalidArgumentException
     */
    public function registerEntity(string $entity, string $alias = null): void
    {
        $metaCached = $this->cache->getItem('metadata.'.strtolower(str_replace('\\\\', '.', $entity)));
        if (!$metaCached->isHit()) {
            $reflectionObject = new \ReflectionObject(new $entity());
            $reflectionProperties = $reflectionObject->getProperties(\ReflectionProperty::IS_PUBLIC | \ReflectionProperty::IS_PROTECTED | \ReflectionProperty::IS_PRIVATE);
            foreach ($reflectionProperties as $reflectionProperty) {
                $annotation = $this->annotationReader->getPropertyAnnotation($reflectionProperty, GeneratedValue::class);
                if (null !== $annotation) {
                    $mapping[self::IDENTITY] = $reflectionProperty->name;
                }
                $annotation = $this->annotationReader->getPropertyAnnotation($reflectionProperty, Column::class);
                if (null !== $annotation) {
                    $mapping[self::MAP][$annotation->name] = $annotation;
                }
                $annotation = $this->annotationReader->getPropertyAnnotation($reflectionProperty, OneToMany::class);
                if (null !== $annotation) {
                    $mapping[self::MAP][$reflectionProperty->name] = $annotation;
                }
                $annotation = $this->annotationReader->getPropertyAnnotation($reflectionProperty, ManyToOne::class);
                if (null !== $annotation) {
                    $mapping[self::MAP][$reflectionProperty->name] = $annotation;
                }
                $annotation = $this->annotationReader->getPropertyAnnotation($reflectionProperty, ManyToMany::class);
                if (null !== $annotation) {
                    $reflector = new \ReflectionClass($entity);
                    $methodName = 'set'.ucfirst($reflectionProperty->name);
                    $params = $reflector->getMethod($methodName)->getParameters();
                    if (1 === \count($params))
                    {
                        $param = $params[0];
                        if ($param->getType() == null || ($param->getType() !== null && $param->getType()->getName() === Collection::class))
                        {
                            $mapping[self::MAP][$reflectionProperty->name] = $annotation;
                        } else {
                            throw new MetadataHydrateException();
                        }
                    } else {
                        throw new MetadataHydrateException();
                    }
                }
            }
            $metaCached->set($mapping);
            $this->cache->save($metaCached);
        }
        $mapping = $metaCached->get();

        if (\array_key_exists(self::IDENTITY, $mapping)) {
            $this->identifiers[$entity] = $mapping[self::IDENTITY];
        }
        $this->metadata[$entity] = $mapping[self::MAP];

        if (null !== $alias) {
            $this->aliases[$alias] = $entity;
        }
    }

    /**
     * @param string $entityClass
     *
     * @return array
     *
     * @throws MetadataNotFoundException
     */
    public function getMetadata(string $entityClass): array
    {
        if (\array_key_exists($entityClass, $this->metadata)) {
            return $this->metadata[$entityClass];
        }

        $entityClass = $this->getClassName($entityClass);

        if (\array_key_exists($entityClass, $this->metadata)) {
            return $this->metadata[$entityClass];
        } else {
            throw new MetadataNotFoundException();
        }
    }

    /**
     * @param string $entityClass
     *
     * @return string
     *
     * @throws MetadataNotFoundException
     */
    public function getIdentity(string $entityClass): string
    {
        if (\array_key_exists($entityClass, $this->identifiers)) {
            return $this->identifiers[$entityClass];
        }

        $entityClass = $this->getClassName($entityClass);

        if (\array_key_exists($entityClass, $this->identifiers)) {
            return $this->identifiers[$entityClass];
        } else {
            throw new MetadataNotFoundException();
        }
    }

    /**
     * @param string $alias
     *
     * @return string
     *
     * @throws MetadataNotFoundException
     */
    public function getClassName(string $alias): string
    {
        if (\array_key_exists($alias, $this->aliases)) {
            return $this->aliases[$alias];
        } else {
            throw new MetadataNotFoundException();
        }
    }
}
