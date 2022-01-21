<?php


namespace Evrinoma\UtilsBundle\Entity;


interface NameInterface
{
    /**
     * @return string
     */
    public function getName(): string;

    /**
     * @param string $name
     *
     * @return self
     */
    public function setName(string $name): self;
}