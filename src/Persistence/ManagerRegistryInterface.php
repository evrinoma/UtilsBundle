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

namespace Evrinoma\UtilsBundle\Persistence;

use Evrinoma\UtilsBundle\Manager\EntityManagerInterface;

interface ManagerRegistryInterface
{
    /**
     * @param EntityManagerInterface $entityManager
     */
    public function registerEntityManager(EntityManagerInterface $entityManager): void;

    /**
     * @throws \InvalidArgumentException
     */
    public function getManager(string $entityClass): EntityManagerInterface;

    /**
     * @param array  $rows
     * @param string $entityClass
     *
     * @return array
     */
    public function hydrateRowData(array $rows, string $entityClass): array;

    /**
     * @param string $entityClass
     * @param mixed  $id
     *
     * @return mixed
     */
    public function &getReference(string $entityClass, $id);

    /**
     * @param callable $func
     *
     * @return mixed
     */
    public function transactional(callable $func);

    public function flush(): void;
}
