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

trait AttributesTrait
{
    /**
     * @var array|null
     *
     * @ORM\Column(name="attributes", type="json", nullable=true)
     */
    protected ?array $attributes = null;

    public function getAttributes(): ?array
    {
        return $this->attributes;
    }

    public function toAttributes(): array
    {
        return $this->getAttributes() ? ['attributes' => $this->getAttributes()] : [];
    }

    public function setAttributes(array $attributes): self
    {
        $this->attributes = $attributes;

        return $this;
    }
}
