<?php


namespace Evrinoma\UtilsBundle\Storage;

/**
 * @deprecated
 */
trait StorageTrait
{
//region SECTION: Fields
    private $entities = [];
//endregion Fields

//region SECTION: Getters/Setters
    public function setEntities(array $entities)
    {
        $this->entities = $entities;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getEntities()
    {
        return $this->entities;
    }

    /**
     * @return int
     */
    public function countEntity():int
    {
        return count($this->entities);
    }

    /**
     * @return bool
     */
    public function hasEntities():bool
    {
        return $this->countEntity() !== 0;
    }

    /**
     * @return bool
     */
    public function hasSingleEntity():bool
    {
        return $this->countEntity() === 1;
    }

    /**
     * @return \Generator|object
     */
    public function generatorEntity():\Generator
    {
        foreach ($this->entities as $entity) {
            yield $entity;
        }
    }
//endregion Getters/Setters
}