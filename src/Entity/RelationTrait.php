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

    /**
     * RelationTrait constructor.
     */
    public function __construct()
    {
        $this->children = new ArrayCollection();
    }

    /**
     * @param $child
     *
     * @return $this
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
     * @return $this
     */
    public function getParent()
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
     * @return $this
     */
    public function setParent($parent): self
    {
        $this->parent = $parent;

        return $this;
    }
}
