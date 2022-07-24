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

use Doctrine\ORM\Mapping as ORM;

trait RolesTrait
{
    /**
     * @var array
     *
     * @ORM\Column(name="roles", type="array", nullable=true)
     */
    protected array $roles = [];

    /**
     * @param string $role
     *
     * @return self
     */
    public function addRole(string $role): self
    {
        $role = strtoupper($role);

        if (!\in_array($role, $this->roles, true)) {
            $this->roles[] = $role;
        }

        return $this;
    }

    /**
     * @param string $role
     *
     * @return self
     */
    public function rmRole(string $role): self
    {
        $role = strtoupper($role);

        $key = array_search($role, $this->roles);
        if (false !== $key) {
            unset($this->roles[$key]);
        }

        return $this;
    }

    /**
     * @param array $roles
     *
     * @return self
     */
    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @param string $role
     *
     * @return bool
     */
    public function hasRole(string $role): bool
    {
        return \in_array(strtoupper($role), $this->getRoles(), true);
    }

    /**
     * @return array
     */
    public function getRoles(): array
    {
        return $this->roles;
    }
}
