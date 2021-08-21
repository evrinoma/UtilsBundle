<?php


namespace Evrinoma\UtilsBundle\Security;


use Evrinoma\UtilsBundle\Security\Configuration\Event;
use Evrinoma\UtilsBundle\Security\Configuration\Form;
use Evrinoma\UtilsBundle\Security\Configuration\Route;

final class Configuration
{
//region SECTION: Fields
    private Event $events;
    private Form  $form;
    private Route $routes;

    private bool $redirectByServer;

    private string $fireWallSessionKey;

//endregion Fields

//region SECTION: Constructor
    /**
     * Configuration constructor.
     *
     * @param bool   $authenticationSuccessEvent
     * @param bool   $authenticationFailureEvent
     * @param bool   $redirectByServer
     * @param string $fireWallSessionKey
     * @param string $loginRoute
     * @param string $loginCheckRoute
     * @param string $defaultRoute
     * @param string $username
     * @param string $password
     * @param string $csrfToken
     */
    public function __construct(bool $authenticationSuccessEvent, bool $authenticationFailureEvent, bool $redirectByServer, string $fireWallSessionKey, string $loginRoute, string $loginCheckRoute, string $defaultRoute, string $username, string $password, string $csrfToken)
    {
        $this->redirectByServer   = $redirectByServer;
        $this->fireWallSessionKey = $fireWallSessionKey;

        $this->events = new Event($authenticationSuccessEvent, $authenticationFailureEvent);
        $this->form   = new Form($username, $password, $csrfToken);
        $this->routes = new Route($loginRoute, $loginCheckRoute, $defaultRoute);
    }
//endregion Constructor

//region SECTION: Public
    /**
     * @return bool
     */
    public function isRedirectByServer(): bool
    {
        return $this->redirectByServer;
    }

    /**
     * @return Event
     */
    public function events(): Event
    {
        return $this->events;
    }

    /**
     * @return Form
     */
    public function form(): Form
    {
        return $this->form;
    }

    /**
     * @return Route
     */
    public function routes(): Route
    {
        return $this->routes;
    }
//endregion Public

//region SECTION: Getters/Setters
    /**
     * @return string
     */
    public function getFireWallSessionKey(): string
    {
        return $this->fireWallSessionKey;
    }
//endregion Getters/Setters
}