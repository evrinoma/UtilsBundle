<?php

namespace Evrinoma\UtilsBundle\Storage;

/**
 * @deprecated
 */
interface StorageInterface
{
//region SECTION: Public
    /**
     * @return int
     */
    public function countEntity(): int;

    /**
     * @return bool
     */
    public function hasSingleEntity(): bool;

    public function generatorEntity(): \Generator;
//endregion Public

//region SECTION: Getters/Setters
    /**
     * @param array $entity
     *
     * @return mixed
     */
    public function setEntities(array $entity);
//endregion Getters/Setters
}