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

namespace Evrinoma\UtilsBundle\Repository\Orm;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Evrinoma\UtilsBundle\QueryBuilder\QueryBuilder;
use Evrinoma\UtilsBundle\QueryBuilder\QueryBuilderInterface;

abstract class RepositoryWrapper extends ServiceEntityRepository
{
    public function createQueryBuilder($alias, $indexBy = null)
    {
        return (new QueryBuilder($this->_em))
            ->select($alias)
            ->from($this->_entityName, $alias, $indexBy);
    }

    public function persistWrapped($entity): void
    {
        $this->getEntityManager()->persist($entity);
    }

    public function removeWrapped($entity): void
    {
        $this->getEntityManager()->remove($entity);
    }

    public function referenceWrapped(string $id)
    {
        return $this->getEntityManager()->getReference($this->getEntityName(), $id);
    }

    public function containsWrapped($entity): bool
    {
        return $this->getEntityManager()->contains($entity);
    }

    public function createQueryBuilderWrapped(string $alias): QueryBuilderInterface
    {
        return $this->createQueryBuilder($alias);
    }

    public function findWrapped($id, $lockMode = null, $lockVersion = null)
    {
        return parent::find($id, $lockMode, $lockVersion);
    }
}
