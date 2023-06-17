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

interface ShortInterface
{
    /**
     * @return string
     */
    public function getShort(): ?string;

    /**
     * @param string $short
     *
     * @return self
     */
    public function setShort(string $short): self;
}
