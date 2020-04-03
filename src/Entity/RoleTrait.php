<?php

namespace Evrinoma\UtilsBundle\Entity;

/**
 * Trait RoleTrait
 *
 * @package Evrinoma\UtilsBundle\Entity
 */
trait RoleTrait
{
    /**
     * @var array
     * @ORM\Column(name="role", type="array", nullable=true)
     */
    protected $role;

    /**
     * @return array|null
     */
    public function getRole(): ?array
    {
        return $this->role;
    }


    /**
     * @param array $role
     *
     * @return self
     */
    public function setRole($role): self
    {
        $this->role = $role;

        return $this;
    }

    /**
     * @param string $role
     *
     * @return self
     */
    public function addRole($role): self
    {
        $this->role[] = $role;

        return $this;
    }
}