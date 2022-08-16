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

trait QueryBuilderTrait
{
    private ?\Closure $closure = null;

    public function skipQuery(): QueryBuilderInterface
    {
        return $this;
    }

    public function getResult(DtoInterface $dto): array
    {
        $entities = [];
        if (null !== $this->closure) {
            $closure = $this->closure;
            $entities = $closure($dto);
        }

        return $entities;
    }

    public function setHandler(\Closure $closure): void
    {
        $this->closure = $closure;
    }
}
