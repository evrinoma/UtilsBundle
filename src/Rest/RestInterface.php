<?php


namespace Evrinoma\UtilsBundle\Rest;


interface RestInterface
{
//region SECTION: Public
    public function isRestStatusOk();
//endregion Public

//region SECTION: Getters/Setters
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
//endregion Getters/Setters
}