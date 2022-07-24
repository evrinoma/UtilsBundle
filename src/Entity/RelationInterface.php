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

interface RelationInterface
{
    /**
     * @param $child
     *
     * @return self
     */
    public function addChild($child): self;

    /**
     * @return bool
     */
    public function hasChildren(): bool;

    /**
     * @return self
     */
    public function getParent(): self;

    /**
     * @return bool
     */
    public function hasParent(): bool;

    /**
     * @return ArrayCollection
     */
    public function getChildren();

    /**
     * @param $parent
     *
     * @return self
     */
    public function setParent($parent = null): self;
}
