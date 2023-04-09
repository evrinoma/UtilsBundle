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

interface StartAtInterface
{
    /**
     * @return bool
     */
    public function hasStartAt(): bool;

    /**
     * @return \DateTimeImmutable
     */
    public function getStartAt(): ?\DateTimeImmutable;

    /**
     * @param \DateTimeImmutable $startAt
     *
     * @return self
     */
    public function setStartAt(\DateTimeImmutable $startAt): self;
}
