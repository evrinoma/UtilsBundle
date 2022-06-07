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

namespace Evrinoma\UtilsBundle\Model;

final class ActiveModel
{
    public const ACTIVE = 'a';
    public const BLOCKED = 'b';
    public const DELETED = 'd';
    public const MODERATED = 'm';
}
