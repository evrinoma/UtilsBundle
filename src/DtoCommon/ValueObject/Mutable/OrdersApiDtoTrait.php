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

namespace Evrinoma\UtilsBundle\DtoCommon\ValueObject\Mutable;

use Evrinoma\DtoBundle\Dto\DtoInterface;
use Evrinoma\UtilsBundle\Dto\OrderApiDtoInterface;
use Evrinoma\UtilsBundle\DtoCommon\ValueObject\Immutable\OrdersApiDtoTrait as OrdersApiDtoImmutableTrait;

trait OrdersApiDtoTrait
{
    use OrdersApiDtoImmutableTrait;

    public function addOrdersApiDto(OrderApiDtoInterface $ordersApiDto): DtoInterface
    {
        $this->ordersApiDto[] = $ordersApiDto;

        return $this;
    }
}
