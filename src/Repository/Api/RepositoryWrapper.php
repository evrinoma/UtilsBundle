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

namespace Evrinoma\UtilsBundle\Repository\Api;

use Doctrine\ORM\Exception\ORMException;
use Evrinoma\UtilsBundle\Persistence\ManagerRegistryInterface;
use Evrinoma\UtilsBundle\QueryBuilder\DummyQueryBuilder;
use Evrinoma\UtilsBundle\QueryBuilder\QueryBuilderInterface;

abstract class RepositoryWrapper
{
    protected ManagerRegistryInterface $managerRegistry;

    protected string $entityClass = '';

    private array $cache = [];

    public function __construct(ManagerRegistryInterface $managerRegistry)
    {
        $this->managerRegistry = $managerRegistry;
    }

    public function referenceWrapped(string $id)
    {
        if (!\array_key_exists($id, $this->cache)) {
            $entity = new $this->entityClass();
            if (method_exists($entity, 'setId')) {
                $entity->setId($id);
                $this->cache[$id] = $entity;
            } else {
                throw new ORMException();
            }
        } else {
            $entity = $this->cache[$id];
        }

        return $entity;
    }

    public function containsWrapped($entity): bool
    {
        return null !== $entity;
    }

    public function createQueryBuilderWrapped(string $alias): QueryBuilderInterface
    {
        $builder = new DummyQueryBuilder();
        $self = $this;
        $builder->setHandler(function ($dto) use ($self) {
            return $self->criteriaWrapped($dto);
        });

        return $builder;
    }

    public function persistWrapped($entity): void
    {
    }

    public function removeWrapped($entity): void
    {
    }

    public function findWrapped($id, $lockMode = null, $lockVersion = null)
    {
        return null;
    }

    protected function criteriaWrapped($entity): array
    {
        return [];
    }
}
