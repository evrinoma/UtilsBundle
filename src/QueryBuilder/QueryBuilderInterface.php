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

namespace Evrinoma\UtilsBundle\QueryBuilder;

use Evrinoma\DtoBundle\Dto\DtoInterface;

interface QueryBuilderInterface
{
    public function skipQuery(): QueryBuilderInterface;

    public function getResult(DtoInterface $dto): array;

    public function setHandler(\Closure $closure): void;
}
