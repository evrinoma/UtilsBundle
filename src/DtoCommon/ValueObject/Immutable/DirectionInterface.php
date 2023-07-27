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

interface DirectionInterface
{
    public const DIRECTION = 'direction';

    /**
     * @return string
     */
    public function getDirection(): string;
}
