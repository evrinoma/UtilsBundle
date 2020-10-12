<?php

namespace Evrinoma\UtilsBundle\Rest;

use Evrinoma\UtilsBundle\Model\RestModel;
use Symfony\Component\HttpFoundation\Response;

/**
 * Trait RestTrait
 *
 * @package Evrinoma\UtilsBundle\Voter\Rest
 */
trait RestTrait
{
//region SECTION: Fields
    private $status = Response::HTTP_OK;
//endregion Fields

//region SECTION: Public
    /**
     * @return bool
     */
    public function isRestStatusOk()
    {
        return $this->getRestStatus() === Response::HTTP_OK;
    }
//endregion Public

//region SECTION: Getters/Setters
    abstract public function getRestStatus(): int;

    /**
     * @return self
     */
    public function setRestSuccessOk(): self
    {
        $this->status = Response::HTTP_OK;

        return $this;
    }

    /**
     * @return self
     */
    public function setRestClientErrorBadRequest(): self
    {
        $this->status = Response::HTTP_BAD_REQUEST;

        return $this;
    }

    /**
     * @return self
     */
    public function setRestClientErrorConflict(): self
    {
        $this->status = Response::HTTP_CONFLICT;

        return $this;
    }

    /**
     * @return self
     */
    public function setRestClientErrorGone(): self
    {
        $this->status = Response::HTTP_GONE;

        return $this;
    }

    /**
     * @return self
     */
    public function setRestServerErrorInternalServerError(): self
    {
        $this->status = Response::HTTP_INTERNAL_SERVER_ERROR;

        return $this;
    }

    /**
     * @return self
     */
    public function setRestServerErrorServiceUnavailable(): self
    {
        $this->status = Response::HTTP_SERVICE_UNAVAILABLE;

        return $this;
    }

    /**
     * @return self
     */
    public function setRestServerErrorUnknownError(): self
    {
        $this->status = RestModel::SERVER_ERROR_UNKNOWN_ERROR;

        return $this;
    }
//endregion Getters/Setters

}