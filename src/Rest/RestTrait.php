<?php

namespace Evrinoma\UtilsBundle\Rest;

use Evrinoma\UtilsBundle\Model\RestModel;

/**
 * Trait RestTrait
 *
 * @package Evrinoma\UtilsBundle\Voter\Rest
 */
trait RestTrait
{
//region SECTION: Fields
    private $status = RestModel::SUCCESS_OK;
//endregion Fields

//region SECTION: Public
    /**
     * @return bool
     */
    public function isRestStatusOk()
    {
        return $this->getRestStatus() === RestModel::SUCCESS_OK;
    }
//endregion Public

//region SECTION: Getters/Setters
    abstract public function getRestStatus(): int;

    /**
     * @return self
     */
    public function setRestSuccessOk(): self
    {
        $this->status = RestModel::SUCCESS_OK;

        return $this;
    }

    /**
     * @return self
     */
    public function setRestClientErrorBadRequest(): self
    {
        $this->status = RestModel::CLIENT_ERROR_BAD_REQUEST;

        return $this;
    }

    /**
     * @return self
     */
    public function setRestClientErrorConflict(): self
    {
        $this->status = RestModel::CLIENT_ERROR_CONFLICT;

        return $this;
    }

    /**
     * @return self
     */
    public function setRestClientErrorGone(): self
    {
        $this->status = RestModel::CLIENT_ERROR_GONE;

        return $this;
    }

    /**
     * @return self
     */
    public function setRestServerErrorInternalServerError(): self
    {
        $this->status = RestModel::SERVER_ERROR_INTERNAL_ERROR;

        return $this;
    }

    /**
     * @return self
     */
    public function setRestServerErrorServiceUnavailable(): self
    {
        $this->status = RestModel::SERVER_ERROR_SERVICE_UNAVAILABLE;

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