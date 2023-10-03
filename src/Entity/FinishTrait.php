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

trait FinishTrait
{
    /**
     * @var \DateTimeImmutable
     *
     * @ORM\Column(name="finish", type="date_immutable", nullable=true)
     */
    protected $finish;

    /**
     * @return bool
     */
    public function hasFinish(): bool
    {
        return null !== $this->finish;
    }

    /**
     * @return \DateTimeImmutable
     */
    public function getFinish(): ?\DateTimeImmutable
    {
        return $this->finish;
    }

    /**
     * @param \DateTimeImmutable $finish
     *
     * @return self
     */
    public function setFinish(\DateTimeImmutable $finish): self
    {
        $this->finish = $finish;

        return $this;
    }
}
