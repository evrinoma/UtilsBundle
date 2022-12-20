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

interface VideoInterface
{
    /**
     * @return string
     */
    public function getVideo(): ?string;

    /**
     * @param string $video
     *
     * @return self
     */
    public function setVideo(string $video): self;
}
