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
}
