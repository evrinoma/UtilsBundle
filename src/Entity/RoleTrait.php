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
    public function addRole(string $role): self
    {
        $this->role[] = $role;

        return $this;
    }
}
