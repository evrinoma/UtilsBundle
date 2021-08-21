<?php


namespace Evrinoma\UtilsBundle\Security\Event;


interface EventInterface
{
//region SECTION: Public
    public function toResponse(): array;
//endregion Public

//region SECTION: Getters/Setters
    public function getRedirectUrl(): string;
//endregion Getters/Setters
}