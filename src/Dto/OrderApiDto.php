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

use Evrinoma\DtoBundle\Dto\AbstractDto;
use Evrinoma\DtoBundle\Dto\DtoInterface;
use Evrinoma\DtoCommon\ValueObject\Mutable\NameTrait;
use Evrinoma\UtilsBundle\DtoCommon\ValueObject\Mutable\DirectionTrait;
use Symfony\Component\HttpFoundation\Request;

class OrderApiDto extends AbstractDto implements OrderApiDtoInterface
{
    use DirectionTrait;
    use NameTrait;

    public function toDto(Request $request): DtoInterface
    {
        $class = $request->get(DtoInterface::DTO_CLASS);

        if ($class === $this->getClass()) {
            $name = $request->get(OrderApiDtoInterface::NAME);
            $direction = $request->get(OrderApiDtoInterface::DIRECTION);

            if ($name) {
                $this->setName($name);
            }
            if ($direction) {
                $this->setDirection($direction);
            }
        }

        return $this;
    }
}
