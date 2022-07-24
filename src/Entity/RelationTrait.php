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

use Doctrine\Common\Collections\ArrayCollection;

trait RelationTrait
{
    protected $parent = null;

    protected $children = null;

    public function __construct()
    {
        $this->children = new ArrayCollection();
    }

    /**
     * @param $child
     *
     * @return self
     */
    public function addChild($child): self
    {
        $child->setParent($this);

        if (!$this->children->contains($child)) {
            $this->children[] = $child;
        }

        return $this;
    }

    /**
     * @return bool
     */
    public function hasChildren(): bool
    {
        return $this->children && 0 !== $this->children->count();
    }

    /**
     * @return bool
     */
    public function hasParent(): bool
    {
        return null !== $this->parent;
    }

    /**
     * @return self
     */
    public function getParent(): self
    {
        return $this->parent;
    }

    /**
     * @return ArrayCollection
     */
    public function getChildren()
    {
        return $this->children;
    }

    /**
     * @param $parent
     *
     * @return self
     */
    public function setParent($parent = null): self
    {
        $this->parent = $parent;

        return $this;
    }
}
