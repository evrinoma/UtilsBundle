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

interface BodyInterface
{
    /**
     * @return string
     */
    public function getBody(): ?string;

    /**
     * @param string $body
     *
     * @return self
     */
    public function setBody(string $body): self;
}
