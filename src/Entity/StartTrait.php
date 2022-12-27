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

trait StartTrait
{
    /**
     * @var \DateTimeImmutable
     *
     * @ORM\Column(name="start", type="date_immutable", nullable=true)
     */
    protected $start;

    /**
     * @return bool
     */
    public function hasStart(): bool
    {
        return null !== $this->start;
    }

    /**
     * @return \DateTimeImmutable
     */
    public function getStart(): ?\DateTimeImmutable
    {
        return $this->start;
    }

    /**
     * @param \DateTimeImmutable $start
     *
     * @return self
     */
    public function setStart(\DateTimeImmutable $start): self
    {
        $this->start = $start;

        return $this;
    }
}
