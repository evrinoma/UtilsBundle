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

interface BriefInterface
{
    /**
     * @return string
     */
    public function getBrief(): ?string;

    /**
     * @param string $brief
     *
     * @return self
     */
    public function setBrief(string $brief): self;
}
