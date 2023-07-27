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
use Evrinoma\UtilsBundle\DtoCommon\ValueObject\Immutable\DirectionTrait as DirectionImmutableTrait;

trait DirectionTrait
{
    use DirectionImmutableTrait;

    /**
     * @param  string       $direction
     * @return DtoInterface
     */
    protected function setDirection(string $direction): DtoInterface
    {
        if ('DESC' !== $direction) {
            $this->setDirectionAsc();
        }

        return $this;
    }

    /**
     * @return DtoInterface
     */
    protected function setDirectionAsc(): DtoInterface
    {
        $this->direction = 'ASC';

        return $this;
    }
}
