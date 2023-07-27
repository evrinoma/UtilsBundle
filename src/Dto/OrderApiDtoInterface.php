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

namespace Evrinoma\UtilsBundle\Dto;

use Evrinoma\DtoCommon\ValueObject\Immutable\NameInterface;
use Evrinoma\UtilsBundle\DtoCommon\ValueObject\Immutable\DirectionInterface;

interface OrderApiDtoInterface extends NameInterface, DirectionInterface
{
    public const ORDER = 'order';
    public const ORDERS = OrderApiDtoInterface::ORDER.'s';
}
