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

interface RolesInterface
{
    /**
     * @param string $role
     *
     * @return self
     */
    public function addRole(string $role): self;

    /**
     * @param string $role
     *
     * @return self
     */
    public function rmRole(string $role): self;

    /**
     * @param array $roles
     *
     * @return self
     */
    public function setRoles(array $roles): self;

    /**
     * @param string $role
     *
     * @return bool
     */
    public function hasRole(string $role): bool;

    /**
     * @return array
     */
    public function getRoles();
}
