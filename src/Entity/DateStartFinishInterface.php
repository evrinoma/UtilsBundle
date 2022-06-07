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

interface DateStartFinishInterface
{
    /**
     * @return bool
     */
    public function hasDateStart(): bool;

    /**
     * @return bool
     */
    public function hasDateFinish(): bool;

    /**
     * @return \DateTimeImmutable
     */
    public function getDateStart(): \DateTimeImmutable;

    /**
     * @return \DateTimeImmutable
     */
    public function getDateFinish(): \DateTimeImmutable;

    /**
     * @param \DateTimeImmutable $dateStart
     *
     * @return self
     */
    public function setDateStart(\DateTimeImmutable $dateStart): self;

    /**
     * @param \DateTimeImmutable $dateFinish
     *
     * @return self
     */
    public function setDateFinish(\DateTimeImmutable $dateFinish): self;
}
