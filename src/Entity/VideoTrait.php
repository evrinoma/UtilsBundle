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

trait VideoTrait
{
    /**
     * @var string
     *
     * @ORM\Column(name="video", type="string", length=2047, nullable=false)
     */
    protected $video;

    /**
     * @return string
     */
    public function getVideo(): ?string
    {
        return $this->video;
    }

    /**
     * @param string $video
     *
     * @return self
     */
    public function setVideo(string $video): self
    {
        $this->video = $video;

        return $this;
    }
}
