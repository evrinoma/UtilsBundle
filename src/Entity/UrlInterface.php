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

interface UrlInterface
{
    /**
     * @return string
     */
    public function getUrl(): ?string;

    /**
     * @param string $url
     *
     * @return self
     */
    public function setUrl(string $url): self;
}
