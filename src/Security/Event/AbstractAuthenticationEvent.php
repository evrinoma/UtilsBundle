<?php


namespace Evrinoma\UtilsBundle\Security\Event;


abstract class AbstractAuthenticationEvent implements EventInterface
{
//region SECTION: Fields
    private string $url      = '';
    private array  $response = [];
//endregion Fields

//region SECTION: Public
    public function toResponse(): array
    {
        return $this->response;
    }

    public function redirectToUrl(): string
    {
        return $this->url;
    }
//endregion Public

//region SECTION: Getters/Setters
    public function setUrl(string $url): EventInterface
    {
        $this->url = $url;

        return $this;
    }

    public function setResponse(array $response): EventInterface
    {
        $this->response = $response;

        return $this;
    }
//endregion Getters/Setters
}