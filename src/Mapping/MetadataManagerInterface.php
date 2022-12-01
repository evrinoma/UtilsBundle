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

use Doctrine\ORM\Mapping\Annotation;
use Evrinoma\UtilsBundle\Exception\MetadataNotFoundException;
use Psr\Cache\InvalidArgumentException;

interface MetadataManagerInterface
{
    /**
     * @param string      $entity
     * @param string|null $alias
     *
     * @throws InvalidArgumentException
     */
    public function registerEntity(string $entity, string $alias = null): void;

    /**
     * @param string $entityClass
     *
     * @return array
     *
     * @throws MetadataNotFoundException
     */
    public function getMetadata(string $entityClass): array;

    /**
     * @param string $entityClass
     * @param string $filedName
     * @param string $classAnnotation
     */
    public function findMetadata(string $entityClass, string $filedName, string $classAnnotation): ?Annotation;

    /**
     * @param string $entityClass
     *
     * @return string
     *
     * @throws MetadataNotFoundException
     */
    public function getIdentity(string $entityClass): string;

    /**
     * @param string $alias
     *
     * @return string
     *
     * @throws MetadataNotFoundException
     */
    public function getClassName(string $alias): string;

    /**
     * @param string $class
     * @param string $fieldName
     *
     * @return string
     */
    public function getSetterName(string $class, string $fieldName): string;
}
