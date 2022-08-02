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

interface RestStatusInterface
{
    public function setStatusOk(): void;

    public function setStatusBadRequest(): void;

    public function setStatusConflict(): void;

    public function setStatusGone(): void;

    public function setStatusInternalServerError(): void;

    public function setStatusServiceUnavailable(): void;

    public function setStatusUnknownError(): void;

    public function setStatusCreated(): void;

    public function setStatusAccepted(): void;

    public function setStatusNotFound(): void;

    public function setStatusNonAuthoritativeInformation(): void;

    public function setStatusNoContent(): void;

    public function setStatusUnprocessableEntity(): void;

    public function setStatusNotImplemented(): void;
}
