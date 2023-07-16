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
    public function addChild($child): self;

    public function hasChildren(): bool;

    public function getParent(): ?self;

    public function hasParent(): bool;

    /**
     * @return ArrayCollection
     */
    public function getChildren();

    public function setParent($parent = null): self;
}
