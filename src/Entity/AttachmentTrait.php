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

trait AttachmentTrait
{
    /**
     * @var string
     *
     * @ORM\Column(name="attachment", type="string", length=2047, nullable=false)
     */
    protected $attachment;

    /**
     * @return string
     */
    public function getAttachment(): ?string
    {
        return $this->attachment;
    }

    /**
     * @param string $attachment
     *
     * @return self
     */
    public function setAttachment(string $attachment): self
    {
        $this->attachment = $attachment;

        return $this;
    }
}
