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

namespace Evrinoma\UtilsBundle\Handler;

use Evrinoma\DtoBundle\Dto\DtoInterface;

final class BaseHandler implements HandlerInterface
{
    public function onPost(DtoInterface $dto, array &$entities, string &$group): void
    {
    }

    public function onPut(DtoInterface $dto, array &$entities, string &$group): void
    {
    }

    public function onGet(DtoInterface $dto, array &$entities, string &$group): void
    {
    }

    public function onCriteria(DtoInterface $dto, array &$entities, string &$group): void
    {
    }
}
