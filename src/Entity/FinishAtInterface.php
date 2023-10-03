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

interface FinishAtInterface
{
    /**
     * @return bool
     */
    public function hasFinishAt(): bool;

    /**
     * @return \DateTimeImmutable
     */
    public function getFinishAt(): ?\DateTimeImmutable;

    /**
     * @param \DateTimeImmutable $finishAt
     *
     * @return self
     */
    public function setFinishAt(\DateTimeImmutable $finishAt): self;
}
