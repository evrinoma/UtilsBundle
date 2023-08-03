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

namespace Evrinoma\UtilsBundle\DtoCommon\ValueObject\Immutable;

trait OrTrait
{
    private bool $or = false;

    /**
     * @return bool
     */
    public function isOr(): bool
    {
        return $this->or;
    }
}
