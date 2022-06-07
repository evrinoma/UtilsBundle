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
interface StorageInterface
{
    /**
     * @return int
     */
    public function countEntity(): int;

    /**
     * @return bool
     */
    public function hasSingleEntity(): bool;

    public function generatorEntity(): \Generator;

    /**
     * @param array $entity
     *
     * @return mixed
     */
    public function setEntities(array $entity);
}
