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

namespace Evrinoma\UtilsBundle\Entity;

interface PositionInterface
{
    /**
     * @return int
     */
    public function getPosition(): int;

    /**
     * @param int $position
     *
     * @return self
     */
    public function setPosition(int $position): self;
}
