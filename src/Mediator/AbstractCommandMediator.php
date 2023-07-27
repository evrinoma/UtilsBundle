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

abstract class AbstractCommandMediator
{
    abstract protected function onUpdate(DtoInterface $dto, $entity);

    abstract protected function onDelete(DtoInterface $dto, $entity);

    abstract protected function onCreate(DtoInterface $dto, $entity);
}
