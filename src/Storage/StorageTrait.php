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

namespace Evrinoma\UtilsBundle\Storage;

/**
 * @deprecated
 */
trait StorageTrait
{
    private $entities = [];

    public function setEntities(array $entities)
    {
        $this->entities = $entities;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getEntities()
    {
        return $this->entities;
    }

    /**
     * @return int
     */
    public function countEntity(): int
    {
        return \count($this->entities);
    }

    /**
     * @return bool
     */
    public function hasEntities(): bool
    {
        return 0 !== $this->countEntity();
    }

    /**
     * @return bool
     */
    public function hasSingleEntity(): bool
    {
        return 1 === $this->countEntity();
    }

    /**
     * @return \Generator|object
     */
    public function generatorEntity(): \Generator
    {
        foreach ($this->entities as $entity) {
            yield $entity;
        }
    }
}
