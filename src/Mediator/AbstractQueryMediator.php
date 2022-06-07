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

namespace Evrinoma\UtilsBundle\Mediator;

use Doctrine\ORM\QueryBuilder;
use Evrinoma\DtoBundle\Dto\DtoInterface;

abstract class AbstractQueryMediator
{
    protected static string $alias = '';

    abstract protected function createQuery(DtoInterface $dto, QueryBuilder $builder): void;

    public function alias(): string
    {
        return static::$alias;
    }

    public function getResult(DtoInterface $dto, QueryBuilder $builder): array
    {
        return $builder->getQuery()->getResult();
    }
}
