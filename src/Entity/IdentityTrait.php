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

trait IdentityTrait
{
    /**
     * @var string
     *
     * @ORM\Column(name="identity", type="string", length=255, nullable=false)
     */
    protected $identity;

    /**
     * @return string
     */
    public function getIdentity(): ?string
    {
        return $this->identity;
    }

    /**
     * @param string $identity
     *
     * @return self
     */
    public function setIdentity(string $identity): self
    {
        $this->identity = $identity;

        return $this;
    }
}
