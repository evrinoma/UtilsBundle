<?php

namespace Evrinoma\UtilsBundle\Rest;

use Evrinoma\UtilsBundle\Model\RestModel;
use Symfony\Component\HttpFoundation\Response;

trait RestTrait
{

    private int $status = Response::HTTP_OK;



    /**
     * @return bool
     */
    public function isRestStatusOk()
    {
        return $this->getRestStatus() === Response::HTTP_OK;
    }



    abstract public function getRestStatus(): int;

    /**
     * @return self
     */
    public function setRestOk(): self
    {
        $this->status = Response::HTTP_OK;

        return $this;
    }

    /**
     * @return self
     */
    public function setRestCreated(): self
    {
        $this->status = Response::HTTP_CREATED;

        return $this;
    }

    /**
     * @return self
     */
    public function setRestAccepted(): self
    {
        $this->status = Response::HTTP_ACCEPTED;

        return $this;
    }


    /**
     * @return self
     */
    public function setRestNoContent(): self
    {
        $this->status = Response::HTTP_NO_CONTENT;

        return $this;
    }

    /**
     * @return self
     */
    public function setRestNotFound(): self
    {
        $this->status = Response::HTTP_NOT_FOUND;

        return $this;
    }

    /**
     * @return self
     */
    public function setRestNonAuthoritativeInformation(): self
    {
        $this->status = Response::HTTP_NON_AUTHORITATIVE_INFORMATION;

        return $this;
    }

    /**
     * @return self
     */
    public function setRestBadRequest(): self
    {
        $this->status = Response::HTTP_BAD_REQUEST;

        return $this;
    }

    /**
     * @return self
     */
    public function setRestConflict(): self
    {
        $this->status = Response::HTTP_CONFLICT;

        return $this;
    }

    /**
     * @return self
     */
    public function setRestGone(): self
    {
        $this->status = Response::HTTP_GONE;

        return $this;
    }

    /**
     * @return self
     */
    public function setRestNotImplemented(): self
    {
        $this->status = Response::HTTP_NOT_IMPLEMENTED;

        return $this;
    }

    /**
     * @return self
     */
    public function setRestUnprocessableEntity(): self
    {
        $this->status = Response::HTTP_UNPROCESSABLE_ENTITY;

        return $this;
    }

    /**
     * @return self
     */
    public function setRestInternalServerError(): self
    {
        $this->status = Response::HTTP_INTERNAL_SERVER_ERROR;

        return $this;
    }

    /**
     * @return self
     */
    public function setRestServiceUnavailable(): self
    {
        $this->status = Response::HTTP_SERVICE_UNAVAILABLE;

        return $this;
    }

    /**
     * @return self
     */
    public function setRestUnknownError(): self
    {
        $this->status = RestModel::UNKNOWN_ERROR;

        return $this;
    }


}