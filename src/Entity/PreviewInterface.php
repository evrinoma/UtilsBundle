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

interface PreviewInterface
{
    /**
     * @return string
     */
    public function getPreview(): ?string;

    /**
     * @param string $preview
     *
     * @return self
     */
    public function setPreview(string $preview): self;
}
