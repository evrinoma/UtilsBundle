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

namespace Evrinoma\UtilsBundle\Facade;

use Evrinoma\DtoBundle\Dto\DtoInterface;

interface FacadeInterface
{
    public function post(DtoInterface $dto, string &$group, array &$data): void;

    public function put(DtoInterface $dto, string &$group, array &$data): void;

    public function delete(DtoInterface $dto, string &$group, array &$data): void;

    public function criteria(DtoInterface $dto, string &$group, array &$data): void;

    public function get(DtoInterface $dto, string &$group, array &$data): void;
}
