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

namespace Evrinoma\UtilsBundle\Rest;

use Symfony\Component\HttpFoundation\Response;

trait RestStatusControllerTrait
{
    private int $status = Response::HTTP_OK;

    public function getRestStatus(): int
    {
        return $this->status;
    }

    abstract public function setRestStatus(\Exception $e): array;
}
