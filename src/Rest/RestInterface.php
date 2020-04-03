<?php


namespace Evrinoma\UtilsBundle\Rest;


interface RestInterface
{
    public function isRestStatusOk();

    public function getRestStatus(): int;

    public function setRestSuccessOk();

    public function setRestClientErrorBadRequest();

    public function setRestClientErrorConflict();

    public function setRestClientErrorGone();

    public function setRestServerErrorInternalServerError();

    public function setRestServerErrorServiceUnavailable();

    public function setRestServerErrorUnknownError();
}