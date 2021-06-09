<?php


namespace Evrinoma\UtilsBundle\Rest;


interface RestInterface
{
//region SECTION: Public
    public function isRestStatusOk();
//endregion Public

//region SECTION: Getters/Setters
    public function getRestStatus(): int;

    public function setRestSuccessOk();

    public function setRestClientErrorBadRequest();

    public function setRestClientErrorConflict();

    public function setRestClientErrorGone();

    public function setRestServerErrorInternalServerError();

    public function setRestServerErrorServiceUnavailable();

    public function setRestServerErrorUnknownError();

    public function setRestCreated();

    public function setRestAccepted();

    public function setRestNotFound();

    public function setRestNonAuthoritativeInformation();
//endregion Getters/Setters
}