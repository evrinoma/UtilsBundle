<?php


namespace Evrinoma\UtilsBundle\Entity;


interface IdentityInterface
{
    /**
     * @return string
     */
    public function getIdentity(): string;

    /**
     * @param string $identity
     *
     * @return $this
     */
    public function setIdentity(string $identity): self;
}