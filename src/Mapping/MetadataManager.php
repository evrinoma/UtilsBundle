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
use Evrinoma\UtilsBundle\Exception\MetadataNotFoundException;
use Symfony\Component\Cache\Adapter\FilesystemAdapter;

class MetadataManager implements MetadataManagerInterface
{
    private array             $metadata = [];
    protected Reader          $annotationReader;
    private string            $cacheDir;
    private FilesystemAdapter $cache;

    public function __construct(string $cacheDir, Reader $annotationReader)
    {
        $this->cacheDir = $cacheDir;
        $this->annotationReader = $annotationReader;
        $this->cache = new FilesystemAdapter('', 0, $this->cacheDir.'/meta');
    }

    /**
     * @param string $entity
     */
    public function registerEntity(string $entity, string $alias = null): void
    {
        $metaCached = $this->cache->getItem('metadata.'.strtolower(str_replace('\\\\', '.', $entity)));
        if (!$metaCached->isHit()) {
            $reflectionObject = new \ReflectionObject(new $entity());
            $reflectionProperties = $reflectionObject->getProperties(\ReflectionProperty::IS_PROTECTED);
            foreach ($reflectionProperties as $reflectionProperty) {
                $annotation = $this->annotationReader->getPropertyAnnotation($reflectionProperty, Column::class);
                if (null !== $annotation) {
                    $mapping[$annotation->name] = $annotation;
                }
            }
            $metaCached->set($mapping);
            $this->cache->save($metaCached);
        }
        $this->metadata[$entity] = $metaCached->get();
        if (null !== $alias) {
            $this->metadata[$alias] = &$this->metadata[$entity];
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
        } else {
            throw new MetadataNotFoundException();
        }
    }
}
