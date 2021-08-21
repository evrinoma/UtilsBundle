<?php

namespace Evrinoma\UtilsBundle\Security\Event;

final class AuthenticationSuccessEvent implements EventInterface
{

//region SECTION: Public
    public function toResponse(): array
    {
        // TODO: Implement toResponse() method.
    }
//endregion Public

//region SECTION: Getters/Setters
    public function getRedirectUrl(): string
    {
        // TODO: Implement getRedirectUrl() method.
    }
//endregion Getters/Setters
}