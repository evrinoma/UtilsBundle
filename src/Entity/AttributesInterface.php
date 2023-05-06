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

interface AttributesInterface
{
    public const ATTRIBUTES = 'attributes';

    public function getAttributes(): ?array;

    public function toAttributes(): array;

    public function setAttributes(array $attributes): self;
}
