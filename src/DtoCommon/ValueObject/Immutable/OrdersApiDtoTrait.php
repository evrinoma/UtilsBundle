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

namespace Evrinoma\UtilsBundle\DtoCommon\ValueObject\Immutable;

use Evrinoma\DtoBundle\Dto\DtoInterface;
use Evrinoma\UtilsBundle\Dto\OrderApiDto;
use Evrinoma\UtilsBundle\Dto\OrderApiDtoInterface;
use Symfony\Component\HttpFoundation\Request;

trait OrdersApiDtoTrait
{
    protected array $ordersApiDto = [];

    protected static string $classOrdersApiDto = OrderApiDto::class;

    public function hasOrdersApiDto(): bool
    {
        return 0 !== \count($this->ordersApiDto);
    }

    public function getOrdersApiDto(): array
    {
        return $this->ordersApiDto;
    }

    public function genRequestOrdersApiDto(?Request $request): ?\Generator
    {
        if ($request) {
            $entities = $request->get(OrderApiDtoInterface::ORDERS);
            if ($entities) {
                foreach ($entities as $entity) {
                    $newRequest = $this->getCloneRequest();
                    $entity[DtoInterface::DTO_CLASS] = static::$classOrdersApiDto;
                    $newRequest->request->add($entity);

                    yield $newRequest;
                }
            }
        }
    }
}
