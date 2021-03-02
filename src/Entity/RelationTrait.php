<?php

namespace Evrinoma\UtilsBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;

/**
 * Trait RelationTrait
 *
 * @package Evrinoma\UtilsBundle\Entity
 */
trait RelationTrait
{

//region SECTION: Fields
    protected $parent = null;

    protected $children = null;
//endregion Fields

//region SECTION: Constructor
    /**
     * RelationTrait constructor.
     */
    public function __construct()
    {
        $this->children = new ArrayCollection();
    }
//endregion Constructor

//region SECTION: Public
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
        return ($this->children && $this->children->count() !== 0);
    }
//endregion Public

//region SECTION: Getters/Setters
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
//endregion Getters/Setters

}