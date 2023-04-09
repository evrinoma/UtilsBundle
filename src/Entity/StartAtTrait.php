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

use Doctrine\ORM\Mapping as ORM;

trait StartAtTrait
{
    /**
     * @var \DateTimeImmutable
     *
     * @ORM\Column(name="start_at", type="datetime_immutable", nullable=true)
     */
    protected $startAt;

    /**
     * @return bool
     */
    public function hasStartAt(): bool
    {
        return null !== $this->startAt;
    }

    /**
     * @return \DateTimeImmutable
     */
    public function getStartAt(): ?\DateTimeImmutable
    {
        return $this->startAt;
    }

    /**
     * @param \DateTimeImmutable $startAt
     *
     * @return self
     */
    public function setStartAt(\DateTimeImmutable $startAt): self
    {
        $this->startAt = $startAt;

        return $this;
    }
}
