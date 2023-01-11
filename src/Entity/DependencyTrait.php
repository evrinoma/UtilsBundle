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

trait DependencyTrait
{
    /**
     * @var string
     *
     * @ORM\Column(name="dependency", type="string", length=255, nullable=false)
     */
    protected $dependency;

    /**
     * @return string
     */
    public function getDependency(): ?string
    {
        return $this->dependency;
    }

    /**
     * @param string $dependency
     *
     * @return self
     */
    public function setDependency(string $dependency): self
    {
        $this->dependency = $dependency;

        return $this;
    }
}
