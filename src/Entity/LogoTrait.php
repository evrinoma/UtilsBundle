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

trait LogoTrait
{
    /**
     * @var string
     *
     * @ORM\Column(name="logo", type="string", length=2047, nullable=false)
     */
    protected $logo;

    /**
     * @return string
     */
    public function getLogo(): ?string
    {
        return $this->logo;
    }

    /**
     * @param string $logo
     *
     * @return self
     */
    public function setLogo(string $logo): self
    {
        $this->logo = $logo;

        return $this;
    }
}
