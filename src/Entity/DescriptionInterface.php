<?php


namespace Evrinoma\UtilsBundle\Entity;


interface DescriptionInterface
{
    /**
     * @return string
     */
    public function getDescription(): string;

    /**
     * @param string $description
     *
     * @return self
     */
    public function setDescription(string $description): self;
}