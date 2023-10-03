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

trait FinishAtTrait
{
    /**
     * @var \DateTimeImmutable
     *
     * @ORM\Column(name="finish_at", type="datetime_immutable", nullable=true)
     */
    protected $finishAt;

    /**
     * @return bool
     */
    public function hasFinishAt(): bool
    {
        return null !== $this->finishAt;
    }

    /**
     * @return \DateTimeImmutable
     */
    public function getFinishAt(): ?\DateTimeImmutable
    {
        return $this->finishAt;
    }

    /**
     * @param \DateTimeImmutable $finishAt
     *
     * @return self
     */
    public function setFinishAt(\DateTimeImmutable $finishAt): self
    {
        $this->finishAt = $finishAt;

        return $this;
    }
}
