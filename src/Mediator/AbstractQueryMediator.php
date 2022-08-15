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

use Evrinoma\DtoBundle\Dto\DtoInterface;
use Evrinoma\UtilsBundle\QueryBuilder\QueryBuilderInterface;

abstract class AbstractQueryMediator
{
    protected static string $alias = '';

    abstract protected function createQuery(DtoInterface $dto, QueryBuilderInterface $builder): void;

    public function alias(): string
    {
        return static::$alias;
    }

    public function getResult(DtoInterface $dto, QueryBuilderInterface $builder): array
    {
        return [];
    }
}
