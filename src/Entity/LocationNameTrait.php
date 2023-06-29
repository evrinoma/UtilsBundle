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

trait LocationNameTrait
{
    /**
     * @var string
     *
     * @ORM\Column(name="location_name", type="string", length=2047, nullable=false)
     */
    protected $locationName;

    /**
     * @return string
     */
    public function getLocationName(): ?string
    {
        return $this->locationName;
    }

    /**
     * @param string $locationName
     *
     * @return self
     */
    public function setLocationName(string $locationName): self
    {
        $this->locationName = $locationName;

        return $this;
    }
}
