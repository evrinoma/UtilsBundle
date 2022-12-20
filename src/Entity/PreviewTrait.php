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

trait PreviewTrait
{
    /**
     * @var string
     *
     * @ORM\Column(name="preview", type="string", length=2047, nullable=false)
     */
    protected $preview;

    /**
     * @return string
     */
    public function getPreview(): ?string
    {
        return $this->preview;
    }

    /**
     * @param string $preview
     *
     * @return self
     */
    public function setPreview(string $preview): self
    {
        $this->preview = $preview;

        return $this;
    }
}
