<?php

namespace Evrinoma\UtilsBundle\Storage;

/**
 * @deprecated
 */
interface StorageInterface
{

    /**
     * @return int
     */
    public function countEntity(): int;

    /**
     * @return bool
     */
    public function hasSingleEntity(): bool;

    public function generatorEntity(): \Generator;



    /**
     * @param array $entity
     *
     * @return mixed
     */
    public function setEntities(array $entity);

}