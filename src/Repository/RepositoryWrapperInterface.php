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

namespace Evrinoma\UtilsBundle\Repository;

use Evrinoma\UtilsBundle\QueryBuilder\QueryBuilderInterface;

interface RepositoryWrapperInterface
{
    public function persistWrapped($entity): void;

    public function removeWrapped($entity): void;

    public function referenceWrapped(string $id);

    public function containsWrapped($entity): bool;

    public function createQueryBuilderWrapped(string $alias): QueryBuilderInterface;

    public function findWrapped($id, $lockMode = null, $lockVersion = null);

    public function resultWrapped($dto): array;
}
