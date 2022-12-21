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

trait BriefTrait
{
    /**
     * @var string
     *
     * @ORM\Column(name="brief", type="string", length=255, nullable=false)
     */
    protected $brief;

    /**
     * @return string
     */
    public function getBrief(): ?string
    {
        return $this->brief;
    }

    /**
     * @param string $brief
     *
     * @return self
     */
    public function setBrief(string $brief): self
    {
        $this->brief = $brief;

        return $this;
    }
}
