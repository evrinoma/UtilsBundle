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

interface AttachmentInterface
{
    /**
     * @return string
     */
    public function getAttachment(): ?string;

    /**
     * @param string $attachment
     *
     * @return self
     */
    public function setAttachment(string $attachment): self;
}
