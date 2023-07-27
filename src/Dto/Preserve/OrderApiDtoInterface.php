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

namespace Evrinoma\UtilsBundle\Dto\Preserve;

use Evrinoma\DtoCommon\ValueObject\Mutable\NameInterface;
use Evrinoma\UtilsBundle\DtoCommon\ValueObject\Mutable\DirectionInterface;

interface OrderApiDtoInterface extends NameInterface, DirectionInterface
{
}
