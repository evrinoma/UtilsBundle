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

final class BaseHandler implements HandlerInterface
{
    public function onPost(array &$entities, string &$group): void
    {
    }

    public function onPut(array &$entities, string &$group): void
    {
    }

    public function onGet(array &$entities, string &$group): void
    {
    }

    public function onCriteria(array &$entities, string &$group): void
    {
    }
}
