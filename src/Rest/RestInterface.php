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

interface RestInterface
{
    public function isRestStatusOk();

    public function getRestStatus(): int;

    public function setRestOk();

    public function setRestBadRequest();

    public function setRestConflict();

    public function setRestGone();

    public function setRestInternalServerError();

    public function setRestServiceUnavailable();

    public function setRestUnknownError();

    public function setRestCreated();

    public function setRestAccepted();

    public function setRestNotFound();

    public function setRestNonAuthoritativeInformation();

    public function setRestNoContent();

    public function setRestUnprocessableEntity();

    public function setRestNotImplemented();
}
