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

trait ShortTrait
{
    /**
     * @var string
     *
     * @ORM\Column(name="short", type="string", length=255, nullable=false)
     */
    protected $short;

    /**
     * @return string
     */
    public function getShort(): ?string
    {
        return $this->short;
    }

    /**
     * @param string $short
     *
     * @return self
     */
    public function setShort(string $short): self
    {
        $this->short = $short;

        return $this;
    }
}
