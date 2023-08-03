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

namespace Evrinoma\UtilsBundle\DtoCommon\ValueObject\Mutable;

use Evrinoma\DtoBundle\Dto\DtoInterface;
use Evrinoma\UtilsBundle\DtoCommon\ValueObject\Immutable\OrTrait as OrImmutableTrait;

trait OrTrait
{
    use OrImmutableTrait;

    /**
     * @return DtoInterface
     */
    protected function setOr(): DtoInterface
    {
        $this->or = true;

        return $this;
    }
}
