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

use Evrinoma\UtilsBundle\Model\Rest\StatusModel;
use Symfony\Component\HttpFoundation\Response;

trait RestStatusTrait
{
    public function setStatusOk(): void
    {
        $this->status = Response::HTTP_OK;
    }

    public function setStatusCreated(): void
    {
        $this->status = Response::HTTP_CREATED;
    }

    public function setStatusAccepted(): void
    {
        $this->status = Response::HTTP_ACCEPTED;
    }

    public function setStatusNoContent(): void
    {
        $this->status = Response::HTTP_NO_CONTENT;
    }

    public function setStatusNotFound(): void
    {
        $this->status = Response::HTTP_NOT_FOUND;
    }

    public function setStatusNonAuthoritativeInformation(): void
    {
        $this->status = Response::HTTP_NON_AUTHORITATIVE_INFORMATION;
    }

    public function setStatusBadRequest(): void
    {
        $this->status = Response::HTTP_BAD_REQUEST;
    }

    public function setStatusConflict(): void
    {
        $this->status = Response::HTTP_CONFLICT;
    }

    public function setStatusGone(): void
    {
        $this->status = Response::HTTP_GONE;
    }

    public function setStatusNotImplemented(): void
    {
        $this->status = Response::HTTP_NOT_IMPLEMENTED;
    }

    public function setStatusUnprocessableEntity(): void
    {
        $this->status = Response::HTTP_UNPROCESSABLE_ENTITY;
    }

    public function setStatusInternalServerError(): void
    {
        $this->status = Response::HTTP_INTERNAL_SERVER_ERROR;
    }

    public function setStatusServiceUnavailable(): void
    {
        $this->status = Response::HTTP_SERVICE_UNAVAILABLE;
    }

    public function setStatusUnknownError(): void
    {
        $this->status = StatusModel::UNKNOWN_ERROR;
    }
}
