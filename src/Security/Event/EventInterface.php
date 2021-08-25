<?php


namespace Evrinoma\UtilsBundle\Security\Event;


interface EventInterface
{
//region SECTION: Public
    public function toResponse(): array;

    public function redirectToUrl(): string;
//endregion Public

//region SECTION: Getters/Setters
    public function setUrl(string $url): EventInterface;

    public function setResponse(array $response): EventInterface;
//endregion Getters/Setters
}